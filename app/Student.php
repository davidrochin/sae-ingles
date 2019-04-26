<?php

namespace App;

use App\Career;
use App\Grade;
use App\Group;
use App\Setting;
use App\ToeflGroup;
use App\StudentToeflGroup;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	//Propiedad "guarded" para evitar MassAsignmentException
    protected $guarded = [
        'id', 
        'user_id'
    ];

    public function career(){
    	//return Career::find($this->career_id);
        return $this->belongsTo(Career::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'student_group')->orderBy('active', 'desc');
    }
    public function toefls(){
        return $this->belongsToMany(ToeflGroup::class, 'student_toefl_group')->orderBy('applied', 'desc');
    }
    
    public function isActive(){
        $groups = $this->groups;
        $isActive = false;
        foreach ($groups as $group) {
            if($group->active == 1){
                $isActive = true;
                break;
            }
        }

        return $isActive;
    }

    public function getAverage($groupId){
        $grades = Grade::where('student_id', $this->id)->where('group_id', $groupId)->get();
        $partialCount = (int)Setting::where('name', 'partial_count')->first()->value;

        $sum = 0;
        for ($i=0; $i < sizeof($grades); $i++) { 
            $sum = $sum + $grades[$i]->score;
        }
        return $sum / $partialCount;
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
