<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function goal() {
        return $this->belongsTo(Goal::class);
    }

    public function taskPosts() {
        return $this->hasMany(Task_post::class);
    }
}
