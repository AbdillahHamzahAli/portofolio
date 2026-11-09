<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Role::findOrCreate('admin');
        $user = Role::findOrCreate('user');
        $permissions = Permission::query()->get();

        $admin->syncPermissions($permissions);
        $user->syncPermissions($permissions->whereIn('name', [
            'ViewAny:Post',
            'View:Post',
            'Create:Post',
            'Update:Post',
            'Delete:Post',
        ]));

        $this->call(PostSeeder::class);
    }
}
