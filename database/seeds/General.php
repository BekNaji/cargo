<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class General extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create(['name' => 'user manage']);
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('user manage');
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => null,
            'password' => 'password', // password
        ]);

        $user->assignRole('admin');
    }
}
