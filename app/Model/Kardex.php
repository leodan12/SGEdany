<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    protected $connection = 'mysql';
    protected $table = 'kardex';
    public $timestamps = false;

    protected $primaryKey = 'idKardex';

    protected $fillable = ['idKardex','idProducto','idUbicacion','Kdx_creacion','Cant_actual','kdx_estado'];


    public function producto()
    {
        return $this->belongsTo('App\Model\Producto', 'idProducto','idProducto');
    }

    public function ubicacion()
    {
        return $this->belongsTo('App\Model\Ubicacion', 'idUbicacion','idUbicacion');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Model\Movimiento', 'idKardex','idKardex');
    } 
}

