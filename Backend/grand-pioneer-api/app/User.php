<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use App\Transformers\Serializer\CustomArraySerializer;
use App\Transformers\UserTransformer;

class User extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'phone_number', 'address', 'gender', 'role'
    ];

    protected $dated = [
        'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        $fractal = new Manager();
        $fractal->setSerializer(new CustomArraySerializer());

        $customClaims = $fractal->createData(new Item($this, app(UserTransformer::class), 'user'))->toArray();

        return $customClaims;
    }
}   