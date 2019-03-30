<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	    //Propiedad "guarded" para evitar MassAsignmentException
    protected $guarded = ['id'];
    public $timestamps = false;
}
