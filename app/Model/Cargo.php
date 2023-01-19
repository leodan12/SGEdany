<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cargo';
    public $timestamps = false;

    protected $primaryKey = 'idCargo';

    protected $fillable = ['idCargo','Car_nombre','Car_descripcion','idArea','Car_estado'];

    public function area()
    {
        return $this->belongsTo('App\Model\Area', 'idArea','idArea');
    }

    public function colaborador()
    {
        return $this->belongsTo('App\Model\Colaborador', 'idCargo','idCargo');
    }
}
