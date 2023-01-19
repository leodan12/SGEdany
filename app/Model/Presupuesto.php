<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $connection = 'mysql';
    protected $table = 'presupuesto';
    public $timestamps = false;

    protected $primaryKey = 'idPresupuesto';

    protected $fillable = ['idPresupuesto','codPresupuesto','idCliente','idResponsable','lugar','concepto','subTotal','gastosAdm','costoTotal','fechaRealizacion','fechaRegistro','pres_estado'];


    public function cliente()
    {
        return $this->belongsTo('App\Model\Cliente', 'idCliente','idCliente');
    }
    public function responsable()
    {
        return $this->belongsTo('App\Model\Responsable', 'idResponsable','idResponsable');
    }

    public function detPresupuesto()
    {
        return $this->hasMany('App\Model\DetPresupuesto', 'idPresupuesto','idPresupuesto');
    }
}
