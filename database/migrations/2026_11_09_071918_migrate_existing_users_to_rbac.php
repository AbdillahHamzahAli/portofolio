<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::findOrCreate('admin');
        Role::findOrCreate('user');

        foreach (User::query()->get() as $user) {
            $user->assignRole($user->is_admin ? 'admin' : 'user');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Roles are intentionally retained for reversibility and future access management.
    }
};
