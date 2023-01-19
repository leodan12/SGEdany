<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    protected $connection = 'mysql';
    protected $table = 'boleta';
    public $timestamps = false;

    protected $primaryKey = 'idBoleta';

    protected $fillable = ['idBoleta','idCol','idPlanilla','sueldoBasico','asigFamiliar','otrosIngresos','ingresoBruto','costoInasist','costoAdelanto','otrosEgresos','egreBruto','costoONP','AFPoblig','AFPcom','AFPseguro','totalAporte','remuneracionNeta','essalud','sctr','Bol_estado'];

    public function colaborador()
    {
        return $this->belongsTo('App\Model\Colaborador', 'idCol','idCol');
    }

    public function planilla()
    {
        return $this->belongsTo('App\Model\Planilla', 'idPlanilla','idPlanilla');
    }
}
