<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    public $table = "localidades";
    //
    protected $fillable = ['nombre', 'precio', 'cupos'];
}
