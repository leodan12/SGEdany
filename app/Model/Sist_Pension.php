<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sist_Pension extends Model
{
    protected $connection = 'mysql';
    protected $table = 'sist_pension';
    public $timestamps = false;

    protected $primaryKey = 'idSistPension';

    protected $fillable = ['idSistPension','Pen_nombre','Porc_obligatorio','Porc_comFlujo','Porc_comMixta','Porc_seguro','Pen_estado'];

    public function colaborador()
    {
        return $this->hasMany('App\Model\Colaborador', 'idSistPension','idSistPension');
    }

}
