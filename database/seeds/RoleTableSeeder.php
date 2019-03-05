<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = new Role();
        $role->name = 'student';
        $role->description = 'Estudiante';
        $role->access_level = 1;
        $role->save();

        $role = new Role();
        $role->name = 'professor';
        $role->description = 'Profesor';
        $role->access_level = 2;
        $role->save();

        $role = new Role();
        $role->name = 'schoolserv';
        $role->description = 'Servicios Escolares';
        $role->access_level = 3;
        $role->save();

        $role = new Role();
        $role->name = 'coordinator';
        $role->description = 'Coordinador';
        $role->access_level = 4;
        $role->save();

        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->access_level = 5;
        $role->save();
    }
}
