<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task_post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function postComments() {
        return $this->hasMany(Post_comment::class);
    }
}
