<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'show roles']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'create campaigns']);
        Permission::create(['name' => 'show campaigns']);
        
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('create roles');
        $role->givePermissionTo('show roles');
        $role->givePermissionTo('create permissions');
        $role->givePermissionTo('create campaigns');
        $role->givePermissionTo('show campaigns');
        
        $user = User::create([
            'name' => 'Mark Willems',
            'email' => 'mark@i-motive.nl',
            'password' => bcrypt('password'),
            'company_id' => '123456789'
        ]);

        $user->assignRole('admin');
    }
}
