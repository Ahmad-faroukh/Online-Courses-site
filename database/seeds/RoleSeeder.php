<?php

use App\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'name' => 'super_admin' ,
            'display_name' => 'Super Admin'
        ]);

        Roles::create([
            'name' => 'user',
            'display_name' => 'User'
        ]);

        Roles::create([
            'name' => 'teacher',
            'display_name' => 'Teacher'
        ]);

    }
}
