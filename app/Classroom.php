<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{

    //Propiedad "guarded" para evitar MassAsignmentException
    protected $guarded = [
        'id'
    ];
	
    public $timestamps = false;
}
