<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function stories()
    {
        return $this->belongsTo(stories::class);
    }
}
