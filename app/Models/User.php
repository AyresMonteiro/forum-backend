<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        "username",
        "email",
        "password",
        "full_name",
        "picture",
        "country",
        "birthday",
    ];

    protected $hidden = [
        "password",
        "remember_token",
    ];

    protected $casts = [
        "email_verified_at" => "datetime",
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
