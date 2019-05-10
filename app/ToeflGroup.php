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
        $scoresStructure = array();

        foreach ($groupScores as $key => $score) {
            $scoresStructure[$score->student_id] = $score->score;
        }

        return $scoresStructure;
    }

    public function group(){
       return $this->belongsTo(ToeflGroup::class);
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

           //Hacer la query
                $groups = $query->where('id', 'LIKE', '%'.$keyword.'%');
            }else{
                //Hacer la query
                $groups = $query->whereIn('applicator_user_id', $usersIds)
                    ->orWhere('id', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('date', 'LIKE', '%'.$keyword.'%')
                    ->orWhereIn('responsable_user_id', $usersIds);

               
            }
           return $query;
        } 
       
  
}