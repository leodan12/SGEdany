<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $connection = 'mysql';
    protected $table = 'servicio';
    public $timestamps = false;

    protected $primaryKey = 'idServicio';

    protected $fillable = ['idServicio','codServicio','serv_nombre','serv_detalle','serv_costo','serv_estado'];

    public function detPresupuesto()
    {
        return $this->hasMany('App\Model\DetPresupuesto', 'codServicio','codServicio');
    }
}
