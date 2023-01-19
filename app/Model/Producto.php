<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $connection = 'mysql';
    protected $table = 'producto';
    public $timestamps = false;

    protected $primaryKey = 'idProducto';

    protected $fillable = ['idProducto','codProducto','Prod_nombre','idTipoProd','Prod_descripcion','Prod_precio','Prod_unidMed','Stock_minimo','Prod_estado'];


    public function tipoProducto()
    {
        return $this->belongsTo('App\Model\Tipo_Producto', 'idTipoProd','idTipoProd');
    }

    public function kardex()
    {
        return $this->hasOne('App\Model\Kardex', 'idProducto','idProducto');
    }

}
