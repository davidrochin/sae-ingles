<?php

use App\Period;
use Illuminate\Database\Seeder;

class PeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Period::create([
        	'name' => 'Enero-Junio',
        	'short_name' => 'Ene-Jun',
        	'start_date' => '2018-01-01',
        	'end_date' => '2018-06-30',
        ]);

        Period::create([
        	'name' => 'Verano',
        	'short_name' => 'Verano',
        	'start_date' => '2018-07-01',
        	'end_date' => '2018-07-31',
        ]);

        Period::create([
        	'name' => 'Agosto-Diciembre',
        	'short_name' => 'Ago-Dic',
        	'start_date' => '2018-08-01',
        	'end_date' => '2018-12-31',
        ]);
    }
}
