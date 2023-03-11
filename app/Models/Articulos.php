<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    use HasFactory;
    protected $tabla='articulos';

    //inner join desde el modelo


    public function categorias(){


    	return $this->belongsTo('App\Models\Categorias', 'id_cat','id_categoria');
    }	
}
