<?php

use App\Permissions;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ======= Role Management ========
        Permissions::create([
            'name' => 'show-roles',
            'Display_name' => 'View Roles'
        ]);
        Permissions::create([
            'name' => 'add-roles',
            'Display_name' => 'Add Roles'
        ]);
        Permissions::create([
            'name' => 'edit-roles',
            'Display_name' => 'Edit Roles'
        ]);
        Permissions::create([
            'name' => 'delete-roles',
            'Display_name' => 'Delete Roles'
        ]);

        // ======= User Management ========
        Permissions::create([
            'name' => 'show-users',
            'Display_name' => 'View Users'
        ]);
        Permissions::create([
            'name' => 'add-users',
            'Display_name' => 'Add Users'
        ]);
        Permissions::create([
            'name' => 'edit-users',
            'Display_name' => 'Edit Users'
        ]);
        Permissions::create([
            'name' => 'delete-users',
            'Display_name' => 'Delete Users'
        ]);

        // ======= Course Management ========
        Permissions::create([
            'name' => 'show-courses',
            'Display_name' => 'View Courses'
        ]);
        Permissions::create([
            'name' => 'add-courses',
            'Display_name' => 'Add Courses'
        ]);
        Permissions::create([
            'name' => 'edit-courses',
            'Display_name' => 'Edit Courses'
        ]);
        Permissions::create([
            'name' => 'delete-courses',
            'Display_name' => 'Delete Courses'
        ]);

        // ======= Topic Management ========
        Permissions::create([
            'name' => 'show-topics',
            'Display_name' => 'View Topics'
        ]);
        Permissions::create([
            'name' => 'add-topics',
            'Display_name' => 'Add Topics'
        ]);
        Permissions::create([
            'name' => 'edit-topics',
            'Display_name' => 'Edit Topics'
        ]);
        Permissions::create([
            'name' => 'delete-topics',
            'Display_name' => 'Delete Topics'
        ]);

        // ======= Category Management ========
        Permissions::create([
            'name' => 'show-categories',
            'Display_name' => 'View Categories'
        ]);
        Permissions::create([
            'name' => 'add-categories',
            'Display_name' => 'Add Categories'
        ]);
        Permissions::create([
            'name' => 'edit-categories',
            'Display_name' => 'Edit Categories'
        ]);
        Permissions::create([
            'name' => 'delete-categories',
            'Display_name' => 'Delete Categories'
        ]);
    }
}
