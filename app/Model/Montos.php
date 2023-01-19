<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Montos extends Model
{
    protected $connection = 'mysql';
    protected $table = 'montos';
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['id','concepto','monto'];


}
