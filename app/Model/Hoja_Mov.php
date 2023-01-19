<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hoja_Mov extends Model
{
    protected $connection = 'mysql';
    protected $table = 'hoja_mov';
    public $timestamps = false;

    protected $primaryKey = 'idHojMov';

    protected $fillable = ['idHojMov','idCol','HM_registro','HM_total','HM_estado'];

    public function colaborador()
    {
        return $this->belongsTo('App\Model\Colaborador', 'idCol','idCol');
    }    

    public function hojaEntrada()
    {
        return $this->hasOne('App\Model\Hoja_Entrada', 'idHojMov','idHojMov');
    }  

    public function hojaSalida()
    {
        return $this->hasOne('App\Model\Hoja_Salida', 'idHojMov','idHojMov');
    }  

    public function movimientos()
    {
        return $this->hasMany('App\Model\Movimiento', 'idHojMov','idHojMov');
    } 
}
