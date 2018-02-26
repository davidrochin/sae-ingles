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
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Christian Lugo';
        $user->email = 'christianrlugo5@gmail.com';
        $user->password = bcrypt('asd987fgh');
        $user->save();
        $user->roles()->attach($role_admin);

        //Coordinadores por defecto =============================
        $user = new User();
        $user->name = 'Coordinador';
        $user->email = 'coordinador@dgtv.com';
        $user->password = bcrypt('coordinador');
        $user->save();
        $user->roles()->attach($role_coordinator);

        //Profesores por defecto ================================
        $user = new User();
        $user->name = 'Profesor A';
        $user->email = 'profesor_a@profesor_a.com';
        $user->password = bcrypt('profesor a');
        $user->save();
        $user->roles()->attach($role_professor);

        $user = new User();
        $user->name = 'Profesor B';
        $user->email = 'profesor_b@profesor_b.com';
        $user->password = bcrypt('profesor b');
        $user->save();
        $user->roles()->attach($role_professor);

        //Alumnos por defecto ===================================
        $user = new User();
        $user->name = 'Alumno A';
        $user->email = 'alumno@alumno.com';
        $user->password = bcrypt('alumno');
        $user->save();
        $user->roles()->attach($role_student);
    }
}