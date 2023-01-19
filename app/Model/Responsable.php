<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $connection = 'mysql';
    protected $table = 'responsable';
    public $timestamps = false;

    protected $primaryKey = 'idResponsable';

    protected $fillable = ['idResponsable','res_nombres','res_apellidos','res_cargo','res_contacto','res_correo','idCliente','res_estado'];

    public function cliente(){
        return $this->belongsTo('App\Model\Cliente','idCliente','idCliente');
    }
    public function presupuestos(){
        return $this->hasMany('App\Model\Presupuesto','idResponsable','idResponsable');
    }
}
