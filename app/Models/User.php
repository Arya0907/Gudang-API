<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory,HasUuids,SoftDeletes;

    protected $fillable = [
        'name', 'email','password','role'
    ];
    protected $hidden = [
        'password',
    ];
    
    public const ADMIN = 'admin';
    public const KURIR = 'kurir';
    public const PELANGGAN = 'pelanggan';

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'user_id');
    }

    public function sentpackages()
    {
        return $this->hasMany(Package::class, 'sender_id');
    }

    public function receivedpackages()
    {
        return $this->hasMany(Package::class, 'receiver_id');
    }
}
