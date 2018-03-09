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
        $role_student = Role::where('name', 'student')->first();
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
        $user->name = 'Coordinador';
        $user->email = 'coordinador@dgtv.com';
        $user->password = bcrypt('coordinador');
        $user->role_id = Role::where('name', 'coordinator')->first()->id;
        $user->save();

        //Profesores por defecto ================================
        $user = new User();
        $user->name = 'Luis López';
        $user->email = 'profesor@hotmail.com';
        $user->password = bcrypt('profesor');
        $user->role_id = Role::where('name', 'professor')->first()->id;
        $user->save();

        $user = new User();
        $user->name = 'John Smith';
        $user->email = 'profesor_b@dgtv.com';
        $user->password = bcrypt('profesor');
        $user->role_id = Role::where('name', 'professor')->first()->id;
        $user->save();

        //Alumnos por defecto ===================================
        $user = new User();
        $user->name = 'Pepito';
        $user->email = 'alumno@dgtv.com';
        $user->password = bcrypt('alumno');
        $user->role_id = Role::where('name', 'student')->first()->id;
        $user->save();
    }
}
