<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_professor = Role::where('name', 'professor')->first();
        $role_coordinator = Role::where('name', 'coordinator')->first();
        $role_admin = Role::where('name', 'admin')->first();

        //Administradores por defecto ===========================
        $user = new User();
        $user->name = 'David Rochín';
        $user->email = 'jdrc8@hotmail.com';
        $user->password = '$2y$10$oi8KHrjGhmZ8qWAMizspMOwBm2WurYBV3sqQTBuLgWfz8JCg1R.9m';
        $user->role_id = Role::where('name', 'admin')->first()->id;
        $user->save();

        $user = new User();
        $user->name = 'Christian Lugo';
        $user->email = 'christianrlugo5@gmail.com';
        $user->password = bcrypt('asd987fgh');
        $user->role_id = Role::where('name', 'admin')->first()->id;
        $user->save();

        //Coordinadores por defecto =============================
        $user = new User();
        $user->name = 'Leticia García';
        $user->email = 'letigarcia@gmail.com';
        $user->password = bcrypt('leticia');
        $user->role_id = Role::where('name', 'coordinator')->first()->id;
        $user->save();
    }
}
