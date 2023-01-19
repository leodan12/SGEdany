<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $connection = 'mysql';
    protected $table = 'colaborador';
    public $timestamps = false;

    protected $primaryKey = 'idCol';

    protected $fillable = ['idCol','idPersona','idCargo','col_sueldo','idSistPension','col_comPen','col_asigFam','col_sctr'];


    public function persona()
    {
        return $this->belongsTo('App\Model\Persona', 'idPersona','idPersona');
    }

    public function cargo()
    {
        return $this->belongsTo('App\Model\Cargo', 'idCargo','idCargo');
    }

    public function pension()
    {
        return $this->belongsTo('App\Model\Sist_Pension', 'idSistPension','idSistPension');
    }

    public function adelantos()
    {
        return $this->hasMany('App\Model\Adelanto','idCol','idCol');
    }

    public function boletas()
    {
        return $this->hasMany('App\Model\Boleta','idCol','idCol');
    }

    public function flujosDinero()
    {
        return $this->hasMany('App\Model\Flujo_Dinero','idCol','idCol');
    }

    public function hojasMov()
    {
        return $this->hasMany('App\Model\Hoja_Mov','idCol','idCol');
    }
   
}
