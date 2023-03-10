<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function task_post() {
        return $this->belongsTo(Task_post::class);
    }
}
