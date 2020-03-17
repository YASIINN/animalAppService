<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalType extends Model
{
    protected $table = "animaltype";

    public function animalpost()
    {
        return $this->hasMany(AnimalPost::class, "atype_id", "id");

    }
}
