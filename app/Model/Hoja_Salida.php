<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hoja_Salida extends Model
{
    protected $connection = 'mysql';
    protected $table = 'hoja_salida';
    public $timestamps = false;

    protected $primaryKey = 'idHojSal';

    protected $fillable = ['idHojSal','idHojMov','Sal_descripcion',];

    public function hojaMov()
    {
        return $this->belongsTo('App\Model\Hoja_Mov', 'idHojMov','idHojMov');
    }
}
