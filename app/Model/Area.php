<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $connection = 'mysql';
    protected $table = 'area';
    public $timestamps = false;

    protected $primaryKey = 'idArea';

    protected $fillable = ['idArea','Are_nombre','Are_descripcion','are_estado'];

    public function cargo()
    {
        return $this->hasMany('App\Model\Cargo', 'idArea','idArea');
    }
}

