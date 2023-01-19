<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tipo_Dcmnto extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tipo_dcmto';
    public $timestamps = false;

    protected $primaryKey = 'idTipoDcmto';

    protected $fillable = ['idTipoDcmto','TD_nombre','TD_estado'];


    public function documentos()
    {
        return $this->hasMany('App\Model\Documento', 'idTipoDcmnto','idTipoDcmnto');
    }

}
