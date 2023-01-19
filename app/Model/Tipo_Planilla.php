<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tipo_Planilla extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tipo_planilla';
    public $timestamps = false;

    protected $primaryKey = 'idTipoPlanilla';

    protected $fillable = ['idTipoPlanilla','TP_nombre','TP_estado'];


    public function planillas()
    {
        return $this->hasMany('App\Model\Planilla', 'idTipoPlanilla','idTipoPlanilla');
    }

}
