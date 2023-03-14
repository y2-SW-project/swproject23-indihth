<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskPost extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }
}
