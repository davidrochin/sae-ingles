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
        $role->name = 'professor';
        $role->description = 'Profesor';
        $role->save();

        $role = new Role();
        $role->name = 'coordinator';
        $role->description = 'Coordinador';
        $role->save();

        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->save();
    }
}
