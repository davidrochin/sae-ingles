<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    //Propiedad "guarded" para evitar MassAsignmentException
    protected $guarded = ['id'];

      public function period(){
    	return $this->belongsTo(Period::class);
    }

}
