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
    	for ($i=2000; $i < 2014; $i++) { 
    		Point::create([
        	'year' => $i,
        	'points' => 350
        	]);
    	}

    	Point::create([
        	'year' => 2014,
        	'points' => 370
        	]);
    	Point::create([
        	'year' => 2015,
        	'points' => 370
        	]);

    	//generaciones 2016-2019
    	for ($i=2016; $i < 2020; $i++) { 
    		Point::create([
        	'year' => $i,
        	'points' => 460
        	]);
    	}
    }
}
