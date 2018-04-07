<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public $timestamps = false;

    //Para buscar carreras
    public function scopeSearch($query, $keyword){
        return $query->where('name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('short_name', 'LIKE', '%'.$keyword.'%');
    }
}
