<?php

use App\Classroom;
use Illuminate\Database\Seeder;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*Classroom::create([
            'name' => 'No asignada',
        ]);*/

    	//Crear las aulas del 1 al 10
    	for ($i=0; $i < 10; $i++) { 
    		Classroom::create([
        	'name' => 'Aula '.($i + 1),
        	]);
    	}

        //Crear el Aula Magna
    	Classroom::create([
    		'name' => 'Aula Magna',
    	]);

    }
}
