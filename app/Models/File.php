<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = "file";
    public function animalpost()
    {
        return $this->belongsToMany(AnimalPost::class, "filepost", "file_id", "animal_post_id");
    }
}
