<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    public $table = "eventos";
    //
    protected $fillable = ['id_lugar', 'nombre'];
}
