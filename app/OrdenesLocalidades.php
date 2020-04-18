<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenesLocalidades extends Model
{
    public $table = "ordenes_localidades";
    //
    protected $fillable = ['id_orden', 'id_localidad', 'cantidad', 'precio'];
}
