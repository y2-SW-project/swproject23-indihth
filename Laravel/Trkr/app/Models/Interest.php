<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Many to many relationship, including the pivot table for a users' interests
    public function users() 
    {
        return $this->belongsToMany(User::class, 'interest_users');
        // return $this->belongsToMany(User::class, 'interest_users', 'interest_id', 'user_id');
    }
}
