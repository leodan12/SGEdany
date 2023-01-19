<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Horas_Trabajadas extends Model
{
    protected $connection = 'mysql';
    protected $table = 'horas_trabajadas';
    public $timestamps = false;

    protected $primaryKey = 'idHrs';

    protected $fillable = ['idHrs','idCol','Hrs_fecha','Hra_inicio','Hrafin','Hrs_cantidad','hrs_estado'];

    public function Persona()
    {
        return $this->belongsTo('App\Model\Colaborador', 'idCol','idCol');
    }

}
