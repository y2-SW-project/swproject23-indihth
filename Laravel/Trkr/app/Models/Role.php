<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_role');
    }

    // Returns query with roles excluding one
    // public function scopeExclude($query, $role)
    // {
    //     return $query->where('name', '!=', $role);
    // }
}
