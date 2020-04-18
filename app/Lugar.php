<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    public $table = "lugares";
    //
    protected $fillable = ['nombre', 'cupos_disponibles'];
}
