<?php

namespace App;
use App\User;
use App\Classroom;
use Illuminate\Database\Eloquent\Model;

class ToeflGroup extends Model
{
    //Propiedad "guarded" para evitar MassAsignmentException
    protected $guarded = ['id'];

    public function responsableUser(){
    	return $this->belongsTo(User::class);
    }

    public function applicatorUser(){
    	return $this->belongsTo(User::class);
    }

    public function students(){
    	return $this->belongsToMany(Student::class, 'student_toefl_group')->orderBy('last_names');
    }
   
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

     public function getScores(){
        $groupScores = StudentToeflGroup::where('toefl_group_id', $this->id)->get();
        $gradesStructure = array();

        foreach ($groupScores as $key => $score) {
            $gradesStructure[$score->student_id] = $score->score;
        }

        return $gradesStructure;
    }
 

   /* public function isActive(){
         $groups = ToeflGroup::orderBy('id', 'DESC');
        $isActive = false;
        foreach ($groups as $group) {
            if($group->active == 1){
                $isActive = true;
                break;
            }
        }

        return $isActive;
    }*/
}
