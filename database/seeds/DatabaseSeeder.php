<?php

use Illuminate\Database\Seeder;
use App\Student;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Student::class)->times(10)->create();
    }
}
