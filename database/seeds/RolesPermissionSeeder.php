<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin','guard_name'=>'api']);
        $permission = Permission::create(['name' => 'view_profile','guard_name'=>'api']);

        $role->givePermissionTo($permission);

        $user = User::where('id',1)->first();
        $user->assignRole('admin');
    }
}
