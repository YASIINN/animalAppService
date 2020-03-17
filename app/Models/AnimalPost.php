<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalPost extends Model
{
    protected $table = "animalpost";

    public function category()
    {
        return $this->belongsToMany(Category::class, "animalpost_category", "animal_post_id", "cat_id");
    }

    public function user()
    {
        return $this->belongsToMany(User::class, "user_post", "animal_post_id", "user_id");
    }

    public function like()
    {
        return $this->belongsToMany(User::class, "user_like", "animal_post_id", "user_id");
    }

    public function file()
    {
        return $this->belongsToMany(File::class, "filepost", "animal_post_id", "file_id");
    }

    public function animaltype()
    {
        return $this->belongsTo(AnimalType::class, "atype_id", "id");
    }

}
