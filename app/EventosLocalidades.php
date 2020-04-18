<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventosLocalidades extends Model
{
    public $table = "eventos_localidades";
    //
    protected $fillable = ['id_evento', 'id_localidad'];
}
