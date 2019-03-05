<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\Role;
use App\User;
use App\Period;
use App\Group;
use App\ToeflGroup;

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
        $this->call(ClassroomTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
        factory(App\User::class)->times(30)->create();
        factory(App\Student::class)->times(1000)->create();
        factory(App\Group::class)->times(50)->create();
        factory(App\ToeflGroup::class)->times(50)->create();

        //Para cada grupo, asignarle alumnos aleatorios
        $groups = Group::all();
        foreach ($groups as $group) {
            $students = Student::inRandomOrder()->get();
            for ($i=0; $i < $group->capacity; $i++) { 
                $group->students()->attach($students[$i]->id);
            }
        }

        //Para cada grupo de TOEFL, asignarle alumnos aleatorios
        $toefl_groups = ToeflGroup::all();
        foreach ($toefl_groups as $toefl_group) {
            $students = Student::inRandomOrder()->get();
            for ($i=0; $i < $toefl_group->capacity; $i++) { 
                $toefl_group->students()->attach($students[$i]->id);
            }
        }

    }
}
