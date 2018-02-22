<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	//Propiedad "guarded" para evitar MassAsignmentException
    protected $guarded = [];
}
