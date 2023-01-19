<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    public $timestamps = false;

    protected $primaryKey = 'idUser';
   
    protected $fillable = [
        'idUser', 'login', 'password','idPersona', 'user_estado'
    ];

    
    protected $hidden = [
        'password',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function persona()
    {
        return $this->belongsTo('App\Model\Persona', 'idPersona','idPersona');
    }
}
