<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;

uses(LazilyRefreshDatabase::class);

test('login renders and public registration is unavailable', function () {
    $this->get(route('login'))->assertOk()->assertSee('Registrasi publik tidak tersedia.');
    $this->get('/register')->assertNotFound();
    $this->post('/register', ['name' => 'Visitor', 'email' => 'visitor@example.com', 'password' => 'new-password-123'])->assertNotFound();
    expect(User::query()->count())->toBe(0);
});

test('admin access requires an authenticated administrator', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    $ordinaryUser = User::factory()->create();
    $this->actingAs($ordinaryUser)->get(route('admin.dashboard'))->assertForbidden();
    $admin = User::factory()->create(['is_admin' => true]);
    $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk()->assertSee($admin->name);
});

test('administrators can log in and log out', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $this->post(route('login'), ['email' => $admin->email, 'password' => 'password', 'remember' => true])
        ->assertRedirect(route('admin.dashboard', absolute: false));
    $this->assertAuthenticatedAs($admin);
    $this->post(route('logout'))->assertRedirect(route('login'));
    $this->assertGuest();
});

test('wrong credentials and ordinary accounts cannot log in as admin', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $ordinaryUser = User::factory()->create();
    $this->post(route('login'), ['email' => $admin->email, 'password' => 'wrong'])->assertSessionHasErrors('email');
    $this->assertGuest();
    $this->post(route('login'), ['email' => $ordinaryUser->email, 'password' => 'password'])->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('login attempts are rate limited', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $key = strtolower($admin->email).'|127.0.0.1';
    RateLimiter::clear($key);
    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post(route('login'), ['email' => $admin->email, 'password' => 'wrong'])->assertSessionHasErrors('email');
    }
    $this->post(route('login'), ['email' => $admin->email, 'password' => 'password'])
        ->assertSessionHasErrors(['email' => 'Terlalu banyak percobaan masuk. Coba lagi dalam '.RateLimiter::availableIn($key).' detik.']);
    $this->assertGuest();
    RateLimiter::clear($key);
});

test('password recovery notifies only administrators without disclosing account existence', function () {
    Notification::fake();
    $admin = User::factory()->create(['is_admin' => true]);
    $ordinaryUser = User::factory()->create();
    $message = 'Jika email terdaftar sebagai admin, tautan reset kata sandi akan dikirim.';
    $this->get(route('password.request'))->assertOk();
    $this->post(route('password.email'), ['email' => $admin->email])->assertSessionHas('status', $message);
    Notification::assertSentTo($admin, ResetPassword::class);
    $this->post(route('password.email'), ['email' => $ordinaryUser->email])->assertSessionHas('status', $message);
    Notification::assertNotSentTo($ordinaryUser, ResetPassword::class);
    $this->post(route('password.email'), ['email' => 'missing@example.com'])->assertSessionHas('status', $message);
    Notification::assertCount(1);
});

test('admin passwords can be reset with a valid token', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $token = Password::createToken($admin);
    $this->get(route('password.reset', ['token' => $token, 'email' => $admin->email]))->assertOk();
    $this->post(route('password.update'), [
        'token' => $token, 'email' => $admin->email,
        'password' => 'new-password-123', 'password_confirmation' => 'new-password-123',
    ])->assertRedirect(route('login'));
    expect(Hash::check('new-password-123', $admin->fresh()->password))->toBeTrue();
});

test('invalid reset tokens cannot change passwords', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $this->post(route('password.update'), [
        'token' => 'invalid', 'email' => $admin->email,
        'password' => 'new-password-123', 'password_confirmation' => 'new-password-123',
    ])->assertSessionHasErrors('email');
    expect(Hash::check('password', $admin->fresh()->password))->toBeTrue();
});

test('ordinary users cannot reset passwords through admin authentication', function () {
    $user = User::factory()->create();
    $token = Password::createToken($user);
    $this->post(route('password.update'), [
        'token' => $token, 'email' => $user->email,
        'password' => 'new-password-123', 'password_confirmation' => 'new-password-123',
    ])->assertSessionHasErrors('email');
    expect(Hash::check('password', $user->fresh()->password))->toBeTrue();
});

test('admin creation validates credentials and never promotes an existing account', function () {
    $this->artisan('admin:create')
        ->expectsQuestion('Nama admin', 'Admin Blog')
        ->expectsQuestion('Email admin', 'admin@example.com')
        ->expectsQuestion('Kata sandi (minimal 12 karakter)', 'secure-password-123')
        ->expectsQuestion('Konfirmasi kata sandi', 'secure-password-123')
        ->assertSuccessful();
    $admin = User::query()->where('email', 'admin@example.com')->firstOrFail();
    expect($admin->is_admin)->toBeTrue();
    expect(Hash::check('secure-password-123', $admin->password))->toBeTrue();

    $this->artisan('admin:create')
        ->expectsQuestion('Nama admin', 'Another Admin')
        ->expectsQuestion('Email admin', 'admin@example.com')
        ->expectsQuestion('Kata sandi (minimal 12 karakter)', 'different-password-123')
        ->expectsQuestion('Konfirmasi kata sandi', 'different-password-123')
        ->assertFailed();
    expect(Hash::check('secure-password-123', $admin->fresh()->password))->toBeTrue();
});
