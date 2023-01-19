<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    
    protected $table = 'persona';
    public $timestamps = false;

    protected $primaryKey = 'idPersona';
   
    protected $fillable = [
        'idPersona', 'per_nombres', 'per_apellidos','per_nacimiento', 'per_dni','per_direccion', 'idSexo','per_cel','per_registro','per_estado'
    ];

    public function Usuario()
    {
        return $this->hasOne('App\User', 'idPersona','idPersona');
    }
    public function colaborador()
    {
        return $this->hasOne('App\Model\Colaborador', 'idPersona','idPersona');
    }

    public function sexo()
    {
        return $this->belongsTo('App\Model\Sexo', 'idSexo','idSexo');
    }
}
