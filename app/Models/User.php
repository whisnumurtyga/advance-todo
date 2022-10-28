<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $collection = 'user';
    protected $primaryKey ='id';
    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'id',
        'password',
        'email'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
