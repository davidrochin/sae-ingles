<?php

use Illuminate\Database\Seeder;
use App\Point;
class PointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //generaciones del 2000-2013
    	for ($i=0; $i < 14; $i++) { 
    		Point::create([
        	'year' => $i,
        	'points' => 350,
        	]);
    	}

    	Point::create([
        	'year' => 14,
        	'points' => 370,
        	]);
    	Point::create([
        	'year' => 15,
        	'points' => 370,
        	]);

    	//generaciones 2016-2019
    	for ($i=16; $i < 20; $i++) { 
    		Point::create([
        	'year' => $i,
        	'points' => 460,
        	]);
    	}
    }
}
