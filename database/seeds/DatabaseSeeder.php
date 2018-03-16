<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\Role;
use App\User;
use App\Period;
use App\Group;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PeriodTableSeeder::class);
        $this->call(CareerTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
        factory(App\User::class)->times(30)->create();
        factory(App\Student::class)->times(70)->create();
        factory(App\Group::class)->times(20)->create();

        //Para cada grupo, asignarle alumnos aleatorios
        $groups = Group::all();
        foreach ($groups as $group) {
            $students = Student::inRandomOrder()->get();
            for ($i=0; $i < 30; $i++) { 
                $group->students()->attach($students[$i]->id);
            }
        }

    }
}
