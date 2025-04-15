<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class stories extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function story_comment()
    {
        return $this->hasMany(story_comment::class);
    }
    public function story_like()
    {
        return $this->hasMany(story_like::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function result()
    {
        return $this->hasMany(result::class);
    }
    // In Story model
    public function questions()
    {
        return $this->hasMany(questions::class);
    }
    public function likedStoryLikes()
    {
        return $this->hasMany(story_like::class)->where('like', 1);
    }
}
