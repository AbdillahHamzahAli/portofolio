<?php

use App\Filament\Resources\Posts\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

test('users can access only their own posts in Filament', function () {
    $user = User::factory()->create();
    $user->assignRole('user');
    $ownPost = Post::factory()->for($user)->create();
    $otherPost = Post::factory()->create();

    $this->actingAs($user);

    expect($user->canAccessPanel(filament()->getPanel('admin')))->toBeTrue()
        ->and(PostResource::getEloquentQuery()->pluck('id')->all())->toBe([$ownPost->id])
        ->and($user->can('update', $ownPost))->toBeTrue()
        ->and($user->can('update', $otherPost))->toBeFalse()
        ->and($user->can('delete', $ownPost))->toBeTrue()
        ->and($user->can('delete', $otherPost))->toBeFalse();
});

test('users cannot manage users or roles', function () {
    $user = User::factory()->create();
    $user->assignRole('user');

    expect($user->can('ViewAny:User'))->toBeFalse()
        ->and($user->can('ViewAny:Role'))->toBeFalse();
});

test('users cannot access user or role management resources', function () {
    $user = User::factory()->create();
    $user->assignRole('user');

    $this->actingAs($user)->get('/admin/users')->assertForbidden();
    $this->actingAs($user)->get('/admin/shield/roles')->assertForbidden();
});

test('admins can access user and role management resources', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $this->actingAs($admin)->get('/admin/users')->assertOk();
    $this->actingAs($admin)->get('/admin/shield/roles')->assertOk();
});

test('admins can manage users and roles', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    expect($admin->canAccessPanel(filament()->getPanel('admin')))->toBeTrue()
        ->and($admin->can('ViewAny:User'))->toBeTrue()
        ->and($admin->can('ViewAny:Role'))->toBeTrue();
});
