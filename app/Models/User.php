<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        "username",
        "email",
        "password",
        "fullName",
        "picture",
        "country",
        "birthday",
    ];

    protected $hidden = [
        "password",
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, "owner_user", "id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, "owner_user", "id");
    }
}
