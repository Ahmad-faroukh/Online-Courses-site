<?php

use App\Roles;
use App\Permissions;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Roles::where('name','super_admin')->firstOrfail();
        $permissions = Permissions::all();

        foreach ($permissions as $permission){
            $superAdmin->grantPermission($permission);
        }
    }
}
