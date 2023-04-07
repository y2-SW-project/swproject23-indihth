<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

     // 1:M relationship between Countries and Users
     public function users() 
    {
        return $this->belongsTo(User::class);
    }
}
