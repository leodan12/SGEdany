<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $connection = 'mysql';
    protected $table = 'sexo';
    public $timestamps = false;

    protected $primaryKey = 'idSexo';

    protected $fillable = ['idSexo','Sex_nombre','Sex_estado'];


    public function persona()
    {
        return $this->hasMany('App\Model\Persona', 'idSexo','idSexo');
    }

}
