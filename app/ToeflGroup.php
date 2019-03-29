<?php

namespace App;
use App\User;
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
}
