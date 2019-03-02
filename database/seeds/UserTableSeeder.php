<?php

use App\User;
use App\Role;
use App\Setting;
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
        $role_schoolserv = Role::where('name', 'schoolserv')->first();

        //Administradores por defecto ===========================
        User::create([
            'name' => 'Administrador por defecto',
            'email' => 'admin@saeingles.com',
            'password' => bcrypt('admin'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);

        User::create([
            'name' => 'David Rochín',
            'email' => 'jdrc8@hotmail.com',
            'password' => '$2y$10$oi8KHrjGhmZ8qWAMizspMOwBm2WurYBV3sqQTBuLgWfz8JCg1R.9m',
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);

        User::create([
            'name' => 'Christian Lugo',
            'email' => 'christianrlugo5@gmail.com',
            'password' => bcrypt('asd987fgh'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);

        User::create([
            'name' => 'Oswaldo Guevara',
            'email' => 'oswaldoguevaras@hotmail.com',
            'password' => bcrypt('1234567890'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);
        //Servicios Escolares por defecto =======================
        User::create([
            'name' => 'Servicios Escolares',
            'email' => 'serviciosescolares@gmail.com',
            'password' => bcrypt('sae'),
            'role_id' => $role_schoolserv->id
        ]);

        //Coordinadores por defecto =============================
        User::create([
            'name' => 'Arq. Ma. Luisa Loya',
            'email' => 'sacleitlm@gmail.com',
            'password' => bcrypt('ingles2018'),
            'role_id' => $role_coordinator->id
        ]);

        User::create([
            'name' => 'Bertha Leticia García',
            'email' => 'blgarciaa@hotmail.com',
            'password' => bcrypt('leticia'),
            'role_id' => $role_coordinator->id
        ]); 

        //Profesores por defecto =============================
        $user = new User();
        $user->name = 'Luis López';
        $user->email = 'luis@hotmail.com';
        $user->password = bcrypt('sae');
        $user->role_id = Role::where('name', 'professor')->first()->id;
        $user->save();

        //Ajustes por defecto
        Setting::create([
            'name' => 'partial_count',
            'value' => '4',
            'display_name' => 'Cantidad de parciales',
            'description' => 'Define la cantidad de parciales que el profesor debe calificar en un grupo.'
        ]);

    }
}
