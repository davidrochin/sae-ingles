<?php

namespace App;

use App\User;
use App\Period;
use App\Classroom;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

	//Propiedad "guarded" para evitar MassAsignmentException
    protected $guarded = ['id'];
	
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function students(){
    	return $this->belongsToMany(Student::class, 'student_group')->orderBy('last_names');
    }

    public function period(){
    	return $this->belongsTo(Period::class);
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    public static function scopeSearch($query, $keyword){
        $groups = null;

        //Revisar que la palabra clave no esté vacía
        if($keyword != ''){

            //Se necesita obtener los ids de los nombres que se parecen a la keyword
            $users = User::searchName($keyword)->get();
            $usersIds = [];
            foreach ($users as $user){
                array_push($usersIds, $user->id);
            }

            //Se necesita obtener los ids de los periodos que se parecen a la keyword
            $periods = Period::search($keyword)->get();
            $periodsIds = [];
            foreach ($periods as $period){
                array_push($periodsIds,$period->id);
            }

            if($keyword == 'lunes' or $keyword == 'Lunes' or $keyword == 'martes' or $keyword == 'Martes' or $keyword == 'miercoles' or $keyword == 'Miercoles' or $keyword == 'miércoles' or $keyword == 'Miércoles' or $keyword == 'jueves' or $keyword == 'Jueves' or $keyword == 'viernes' or $keyword == 'Viernes' or $keyword == 'sabado' or $keyword == 'Sabado' or $keyword == 'sábado' or $keyword == 'Sábado'){
                if($keyword == 'lunes' or $keyword == 'Lunes'){
                    $keyword = '1';
                }
                if($keyword == 'martes' or $keyword == 'Martes'){
                    $keyword = '2';
                }
                if($keyword == 'miercoles' or $keyword == 'Miercoles' or $keyword == 'miércoles' or $keyword == 'Miércoles'){
                    $keyword = '3';
                }
                if($keyword == 'jueves' or $keyword == 'Jueves'){
                    $keyword = '4';
                }
                if($keyword == 'viernes' or $keyword == 'Viernes'){
                    $keyword = '5';
                }
                if($keyword == 'sabado' or $keyword == 'Sabado' or $keyword == 'sábado' or $keyword == 'Sábado'){
                    $keyword = '6';
                }

                //dd($keyword);

                //Hacer la query
                $groups = $query->where('days', 'LIKE', '%'.$keyword.'%');
            }else{
                //Hacer la query
                $groups = $query->whereIn('user_id', $usersIds)
                    ->orWhere('id', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('level', 'LIKE', '%'.$keyword.'%')
                    ->orWhereIn('period_id', $periodsIds)
                    ->orWhere('year', 'LIKE', '%'.$keyword.'%')
                    //No se implementó, porque no mostramos en que aula se toma la clase
                    //->orWhere('classroom', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('code', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('name', 'LIKE', '%'.$keyword.'%');

                //dd($groups->get());
            }

        }
        return $query;
    }
}
