<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $connection = 'mysql';
    protected $table = 'empresa';
    public $timestamps = false;

    protected $primaryKey = 'idEmpresa';

    protected $fillable = ['idEmpresa','RUC','RazonSocial','NombreComercial','Direccion','Rubro','Emp_estado'];

    public function documentos()
    {
        return $this->hasMany('App\Model\Documento','idEmpresa','idEmpresa');
    }

}
