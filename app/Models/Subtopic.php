<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtopic extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "summary",
        "owner_topic",
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, "owner_subtopic", "id");
    }

    public function latestPost()
    {
        return $this->hasOne(Post::class, "owner_subtopic", "id")->latest();
    }
}
