<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cliente';
    public $timestamps = false;

    protected $primaryKey = 'idCliente';

    protected $fillable = ['idCliente','clie_identificador','clie_tipo','clie_estado'];

    public function presupuestos(){
        return $this->hasMany('App\Model\Presupuesto','idCliente','idCliente');
    }
    public function responsables(){
        return $this->hasMany('App\Model\Responsable','idCliente','idCliente');
    }

}
