<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Hoja_Entrada extends Model
{
    protected $connection = 'mysql';
    protected $table = 'hoja_entrada';
    public $timestamps = false;

    protected $primaryKey = 'idHojEnt';

    protected $fillable = ['idHojEnt','idHojMov','idDocumento'];

    public function hojaMov(){
        return $this->belongsTo('App\Model\Hoja_Mov', 'idHojMov','idHojMov');
    }
    public function documento(){
        return $this->belongsTo('App\Model\Documento', 'idDocumento','idDocumento');
    }
}
