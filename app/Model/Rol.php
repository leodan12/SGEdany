<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    public $timestamps = false;

    protected $primaryKey = 'idRol';
   
    protected $fillable = [
        'idRol', 'rol_nombre','rol_permiso', 'rol_estado'
    ];

    public function persona()
    {
        return $this->hasMany('App\Model\Persona', 'idRol','idRol');
    }
}
