<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetPresupuesto extends Model
{
    protected $connection = 'mysql';
    protected $table = 'det_presupuesto';
    public $timestamps = false;

    protected $primaryKey = 'idDetPresupuesto';

    protected $fillable = ['idDetPresupuesto','idPresupuesto','codServicio','cantidad','costUnid'];

    public function presupuesto(){
        return $this->belongsTo('App\Model\Presupuesto','idPresupuesto','idPresupuesto');
    }

    public function servicio(){
        return $this->belongsTo('App\Model\Servicio','codServicio','codServicio');
    }
}
