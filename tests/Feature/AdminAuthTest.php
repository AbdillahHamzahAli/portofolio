<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(LazilyRefreshDatabase::class);

test('Filament provides the only admin authentication entry point', function () {
    $this->get('/admin/login')->assertOk();
    $this->get('/login')->assertNotFound();
    $this->get('/register')->assertNotFound();
});

test('admin access requires an authenticated administrator', function () {
    $this->get('/admin')->assertRedirect('/admin/login');

    $ordinaryUser = User::factory()->create();
    $this->actingAs($ordinaryUser)->get('/admin')->assertForbidden();

    $admin = User::factory()->create(['is_admin' => true]);
    $this->actingAs($admin)->get('/admin')->assertOk()->assertSee('Dashboard');
});

test('Filament password reset pages are available', function () {
    $this->get('/admin/password-reset/request')->assertOk();
});

test('admin creation validates credentials and never promotes an existing account', function () {
    $this->artisan('admin:create')
        ->expectsQuestion('Nama admin', 'Admin Blog')
        ->expectsQuestion('Email admin', 'admin@example.com')
        ->expectsQuestion('Kata sandi (minimal 8 karakter)', 'secure-password-123')
        ->expectsQuestion('Konfirmasi kata sandi', 'secure-password-123')
        ->assertSuccessful();

    $admin = User::query()->where('email', 'admin@example.com')->firstOrFail();

    expect($admin->is_admin)->toBeTrue();
    expect(Hash::check('secure-password-123', $admin->password))->toBeTrue();

    $this->artisan('admin:create')
        ->expectsQuestion('Nama admin', 'Another Admin')
        ->expectsQuestion('Email admin', 'admin@example.com')
        ->expectsQuestion('Kata sandi (minimal 8 karakter)', 'different-password-123')
        ->expectsQuestion('Konfirmasi kata sandi', 'different-password-123')
        ->assertFailed();

    expect(Hash::check('secure-password-123', $admin->fresh()->password))->toBeTrue();
});
