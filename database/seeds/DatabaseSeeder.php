<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\Role;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CareerTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);

        // $this->call(UsersTableSeeder::class);
        factory(App\User::class)->times(30)->create();
        factory(App\Student::class)->times(70)->create();
        factory(App\Group::class)->times(20)->create();

    }
}
