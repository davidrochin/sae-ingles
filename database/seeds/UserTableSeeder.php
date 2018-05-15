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

        //Administradores por defecto ===========================
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

        //Coordinadores por defecto =============================
        $user = new User();
        $user->name = 'Leticia García';
        $user->email = 'letigarcia@gmail.com';
        $user->password = bcrypt('leticia');
        $user->role_id = Role::where('name', 'coordinator')->first()->id;
        $user->save();

        //Profesores por defecto =============================
        $user = new User();
        $user->name = 'Profesor no registrado';
        $user->email = 'profesor@hotmail.com';
        $user->password = bcrypt('profesor');
        $user->role_id = Role::where('name', 'professor')->first()->id;
        $user->save();

        $user = new User();
        $user->name = 'Luis López';
        $user->email = 'luis@hotmail.com';
        $user->password = bcrypt('luis');
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
