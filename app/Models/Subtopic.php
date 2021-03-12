<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtopic extends Model
{
    use HasFactory;


    public function posts() {
        return $this->hasMany(Post::class, 'owner_subtopic', 'uuid');
    }

    public function latestPost() {
        return $this->hasOne(Post::class, 'owner_subtopic', 'uuid')->latest();
    }
}
