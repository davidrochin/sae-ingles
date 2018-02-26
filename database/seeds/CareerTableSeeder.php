<?php

use App\Career;
use Illuminate\Database\Seeder;

class CareerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $career = new Career(); $career->short_name = 'No regist.'; $career->name = 'Carrera no registrada'; $career->save();
        $career = new Career(); $career->short_name = 'Externo'; $career->name = 'Alumno externo'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Industrial'; $career->name = 'Ingeniería Industrial'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Informática'; $career->name = 'Ingeniería en Informática'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Electrónica'; $career->name = 'Ingeniería en Electrónica'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Electromecánica'; $career->name = 'Ingeniería en Mecatrónica'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Ind. Alimentarias'; $career->name = 'Ingeniería en Industrias Alimentarias'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Innovación Agrícola S.'; $career->name = 'Ingeniería en Innovación Agrícola Sustentable'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Bioquímica'; $career->name = 'Ingeniería en Bioquímica'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Química'; $career->name = 'Ingeniería en Química'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Gest. Empresarial'; $career->name = 'Ingeniería en Gestión Empresarial'; $career->save();
        $career = new Career(); $career->short_name = 'Ing. Mecatrónica'; $career->name = 'Ingeniería en Mecatrónica'; $career->save();
        $career = new Career(); $career->short_name = 'Lic. Administración'; $career->name = 'Licenciatura en Administración'; $career->save();
        $career = new Career(); $career->short_name = 'Lic. Biología'; $career->name = 'Licenciatura en Biología'; $career->save();
        $career = new Career(); $career->short_name = 'Contador Público'; $career->name = 'Contador Público'; $career->save();
        $career = new Career(); $career->short_name = 'Arquitectura'; $career->name = 'Arquitectura'; $career->save();
    }
}
