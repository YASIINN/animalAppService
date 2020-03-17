<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Contracts\Providers\JWT;

class User extends Model /*implements JWTSubject*/
{

    protected $table = "user";

    public function password()
    {
        return $this->hasMany(Password::class, "user_id", "id");

    }

    public function animalpost()
    {
        return $this->belongsToMany(AnimalPost::class, "user_post", "user_id", "animal_post_id")->with(['file']);
    }

    public function likepost()
    {
        return $this->belongsToMany(AnimalPost::class, "user_post", "user_id", "animal_post_id")->with(['file']);
    }

    /*    public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        public function getJWTCustomClaims()
        {
            return [];
        }*/
}
