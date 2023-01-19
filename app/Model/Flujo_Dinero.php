<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Flujo_Dinero extends Model
{
    protected $connection = 'mysql';
    protected $table = 'flujo_dinero';
    public $timestamps = false;

    protected $primaryKey = 'idFlujo';

    protected $fillable = ['idFlujo','Flu_monto','Flu_motivo','Flu_fecha','Flu_registro','idTipoFlujo','idCol','Flu_estado'];

    public function colaborador(){
        return $this->belongsTo('App\Model\Colaborador','idCol','idCol');
    }

    public function tipoFlujo(){
        return $this->belongsTo('App\Model\Tipo_Flujo','idTipoFlujo','idTipoFlujo');
    }
}
