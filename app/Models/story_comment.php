<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class story_comment extends Model
{
    /** @use HasFactory<\Database\Factories\StoryCommentFactory> */
    use HasFactory;
    public function stories()
    {
        return $this->belongsTo(stories::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
