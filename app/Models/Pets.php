<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    use HasFactory;
protected $table = "mascotas";

    /*protected $fillable=[ 
    	'id_tipomascota_fk',
    	'id_cliente_fk',
    	'nombre'


    ];*/

    public function client(){

    	return $this->belongsTo('App\Models\User', 'id');


    }

    public function TypePet(){

    	return $this->belongsTo('App\Models\TypePet', 'id_mascota');


    }

    public function Appoiments(){

    	return $this->hasMany('App\Models\Appoiments', 'id');


    }
}
