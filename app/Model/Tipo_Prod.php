<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tipo_Prod extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tipo_prod';
    public $timestamps = false;

    protected $primaryKey = 'idTipoProd';

    protected $fillable = ['idTipoProd','TP_nombre','TP_codigo','TP_estado'];


    public function productos()
    {
        return $this->hasMany('App\Model\Producto', 'idTipoProd','idTipoProd');
    }

}
