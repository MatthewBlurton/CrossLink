<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // User privelages
        Permission::create(['name' => 'browse users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'search users']);

        // Bookmark privelages
        Permission::create(['name' => 'browse bookmarks']);
        Permission::create(['name' => 'read bookmarks']);
        Permission::create(['name' => 'edit bookmarks']);
        Permission::create(['name' => 'add bookmarks']);
        Permission::create(['name' => 'delete bookmarks']);
        Permission::create(['name' => 'search bookmarks']);

        // Profile privelages
        Permission::create(['name' => 'browse profiles']);
        Permission::create(['name' => 'read profiles']);
        Permission::create(['name' => 'edit profiles']);
        Permission::create(['name' => 'add profiles']);
        Permission::create(['name' => 'delete profiles']);
        Permission::create(['name' => 'search profiles']);

        // Role assignment privelages
        Permission::create(['name' => 'suspend user']);
        Permission::create(['name' => 'assign role']);

        // Admin level privelages
        Permission::create(['name' => 'access all ordinary users']);
        Permission::create(['name' => 'access all users']);
        Permission::create(['name' => 'access admins']);
        Permission::create(['name' => 'access all tags']);
        Permission::create(['name' => 'access all bookmarks']);
        Permission::create(['name' => 'access all profiles']);

        // Bundle permissions together
        // Users
        $usersEdBundle = ['edit users', 'delete users'];

        // Bookmarks
        $bookmarksEadBundle = [
            'edit bookmarks',
            'add bookmarks',
            'delete bookmarks'
        ];

        $profilesBreadsBundle = [
            'browse profiles',
            'read profiles',
            'edit profiles',
            'add profiles',
            'delete profiles',
            'search profiles'
        ];


        // Create roles and assign created permissions
        Role::create(['name' => 'suspended']);
        Role::create(['name' => 'user'])
            ->givePermissionTo($bookmarksEadBundle)
            ->givePermissionTo($profilesBreadsBundle)
            ->givePermissionTo('edit users');
        Role::create(['name' => 'user-admin'])
            ->givePermissionTo($usersEdBundle)
            ->givePermissionTo($profilesBreadsBundle)
            ->givePermissionTo([
                'access all ordinary users',
                'access all profiles',
                'suspend user',
                'assign role',
            ]);
        Role::create(['name' => 'admin'])
            ->givePermissionTo($usersEdBundle)
            ->givePermissionTo($bookmarksEadBundle)
            ->givePermissionTo($profilesBreadsBundle)
            ->givePermissionTo([
                'access all users',
                'access all tags',
                'access all bookmarks',
                'access all profiles',
                'suspend user',
                'assign role',
            ]);
        Role::create(['name' => 'root'])
            ->givePermissionTo($usersEdBundle)
            ->givePermissionTo($bookmarksEadBundle)
            ->givePermissionTo($profilesBreadsBundle)
            ->givePermissionTo([
                'access all users',
                'access all admins',
                'access all tags',
                'access all bookmarks',
                'access all profiles',
                'suspend user',
                'assign role',
            ]);
    }
}
