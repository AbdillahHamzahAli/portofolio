<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        $user = Role::findOrCreate('user');
        $postPermissions = Permission::query()
            ->whereIn('name', ['ViewAny:Post', 'View:Post', 'Create:Post', 'Update:Post', 'Delete:Post'])
            ->get();

        $user->syncPermissions($postPermissions);
        Role::query()->where('name', 'super_admin')->delete();

        if (Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->dropColumn('is_admin');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->boolean('is_admin')->default(false);
            });
        }
    }
};
