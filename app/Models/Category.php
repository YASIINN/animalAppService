<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    public function animalpost()
    {
        return $this->belongsToMany(AnimalPost::class, "animalpost_category", "cat_id", "animal_post_id");
    }

}
