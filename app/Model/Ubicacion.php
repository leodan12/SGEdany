<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ubicacion';
    public $timestamps = false;

    protected $primaryKey = 'idUbicacion';

    protected $fillable = ['idUbicacion','Ubic_nombre','Ubic_estado'];


    public function kardex()
    {
        return $this->hasMany('App\Model\Kardex', 'idUbicacion','idUbicacion');
    }

}
