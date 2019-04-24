<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentToeflGroup extends Model
{
   protected $table = 'student_toefl_group';

 

    public function group(){
    	//return Career::find($this->career_id);
        return $this->belongsTo(ToeflGroup::class);
    }

}
