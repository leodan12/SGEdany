<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jubilacion extends Model
{
    protected $connection = 'mysql';
    protected $table = 'jubilacion';
    public $timestamps = false;

    protected $primaryKey = 'idJubilacion';

    protected $fillable = ['idJubilacion','idCol','jub_fecha','jub_estado'];



}
