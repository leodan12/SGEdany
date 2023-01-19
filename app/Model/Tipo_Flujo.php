<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tipo_Flujo extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tipo_flujo';
    public $timestamps = false;

    protected $primaryKey = 'idTipoFlujo';

    protected $fillable = ['idTipoFlujo','TF_nombre','TF_estado'];


    public function flujoDinero()
    {
        return $this->hasMany('App\Model\FLujo_Dinero', 'idTipoFlujo','idTipoFlujo');
    }

}
