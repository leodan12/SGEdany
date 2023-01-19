<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Adelanto extends Model
{
    protected $connection = 'mysql';
    protected $table = 'adelanto';
    public $timestamps = false;

    protected $primaryKey = 'idAdelanto';

    protected $fillable = ['idAdelanto','Adel_monto','Adel_fecha','Adel_registro','idCol','adel_estado'];

    public function colaborador()
    {
        return $this->belongsTo('App\Model\Colaborador', 'idCol','idCol');
    }
}
