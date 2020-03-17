<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $table = "password";
    public  function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }

}
