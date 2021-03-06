<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps();;
    }
    public function stories()
    {
        return $this->belongsToMany(Story::class)->withTimestamps();;
    }

    public function ratings() {
        return $this->hasMany(Rating::class, 'user_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function storyRatings() {
        return $this->hasMany(StoryRating::class, 'user_id');
    }

    public function storyComments() {
        return $this->hasMany(StoryComment::class, 'user_id');
    }


}
