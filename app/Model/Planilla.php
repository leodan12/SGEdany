<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    protected $connection = 'mysql';
    protected $table = 'planilla';
    public $timestamps = false;

    protected $primaryKey = 'idPlanilla';

    protected $fillable = ['idPlanilla','Periodo','Plan_inicio','Plan_final','Plan_registro','idTipoPlanilla','Plan_costo'];


    public function tipoPlanilla()
    {
        return $this->belongsTo('App\Model\Tipo_planiilla', 'idTipoPlanilla','idTipoPlanilla');
    }

    public function boletas()
    {
        return $this->hasMany('App\Model\Boleta', 'idPlanilla','idPlanilla');
    }

}
