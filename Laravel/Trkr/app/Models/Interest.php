<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    // Many to many relationship, including the pivot table for a users' interests
    public function users() 
    {
        return $this->belongsToMany('App\Models\User', 'interest_users', 'interest_id', 'user_id');
    }
}
