<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $permissionNames = [
            'ViewAny:Post', 'View:Post', 'Create:Post', 'Update:Post', 'Delete:Post', 'DeleteAny:Post',
            'ViewAny:User', 'View:User', 'Create:User', 'Update:User', 'Delete:User', 'DeleteAny:User',
            'ViewAny:Role', 'View:Role', 'Create:Role', 'Update:Role', 'Delete:Role', 'DeleteAny:Role',
        ];

        foreach ($permissionNames as $permissionName) {
            Permission::findOrCreate($permissionName, 'web');
        }

        $admin = Role::findOrCreate('admin');
        $user = Role::findOrCreate('user');
        $permissions = Permission::query()->get();

        $admin->syncPermissions($permissions);
        $user->syncPermissions($permissions->filter(fn (Permission $permission): bool => str_ends_with($permission->name, ':Post')));

        foreach (User::query()->get() as $account) {
            $account->assignRole($account->is_admin ? 'admin' : 'user');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
