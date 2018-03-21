<?php

namespace App;

use App\Career;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	//Propiedad "guarded" para evitar MassAsignmentException
    protected $guarded = ['id'];

    public function career(){
    	//return Career::find($this->career_id);
        return $this->belongsTo(Career::class);
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'student_group')->orderBy('active', 'desc');
    }

    //Falta probar esta función con Student::like('control_number', '14440590')->get();
    public function scopeLike($query, $field, $value){
    	return $query->where($field, 'LIKE', "%$value%");
    }

    public static function scopeSearch($query, $keyword){
        $students = null;

        //Revisar que la palabra clave no esté vacía
        if($keyword != ''){

            //Se necesitan obtener los ids de las carreras que se parecen a la keyword
            $careers = Career::search($keyword)->get();
            $careersIds = [];
            foreach ($careers as $career) {
                array_push($careersIds, $career->id);
            }

            //Hacer la query
            $students = $query->whereIn('career_id', $careersIds)
                ->orWhere('id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('first_names', 'LIKE', '%'.$keyword.'%')
                ->orWhere('last_names', 'LIKE', '%'.$keyword.'%')
                ->orWhere('phone_number', 'LIKE', '%'.$keyword.'%')
                ->orWhere('email', 'LIKE', '%'.$keyword.'%')
                ->orWhere('control_number', 'LIKE', '%'.$keyword.'%');

                //dd($students->get());
        }
        return $query;
    }
}
