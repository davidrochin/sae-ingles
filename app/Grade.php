<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //Propiedad "guarded" para evitar MassAsignmentException
    protected $guarded = ['id'];

    public function student(){
    	return $this->belongsTo(Student::class);
    }

}
