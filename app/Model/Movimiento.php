<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $connection = 'mysql';
    protected $table = 'movimiento';
    public $timestamps = false;

    protected $primaryKey = 'idMovimiento';

    protected $fillable = ['idMovimiento','idKardex','idHojMov','Mov_cantidad','Mov_costo'];


    public function kardex()
    {
        return $this->belongsTo('App\Model\Kardex', 'idKardex','idKardex');
    }

    public function hojaMov()
    {
        return $this->belongsTo('App\Model\Hoja_Mov', 'idHojMov','idHojMov');
    }

}
