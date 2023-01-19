<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $connection = 'mysql';
    protected $table = 'documento';
    public $timestamps = false;

    protected $primaryKey = 'idDocumento';

    protected $fillable = ['idDocumento','idTipoDcmto','Dcmto_codigo','idEmpresa','Dcmto_precio','Dcmto_emision','Dcmto_archivo','Dcmto_estado'];

    public function tipoDoc(){
        return $this->belongsTo('App\Model\Tipo_Dcmnto','idTipoDcmto','idTipoDcmto');
    }
    public function empresa(){
        return $this->belongsTo('App\Model\Empresa','idEmpresa','idEmpresa');
    }
    
}
