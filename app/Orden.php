<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    public $table = "ordenes";
    //
    protected $fillable = ['id_cliente', 'total', 'id_evento', 'asientos', ];
}
