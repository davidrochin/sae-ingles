<?php

namespace App;

use App\User;
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
}
