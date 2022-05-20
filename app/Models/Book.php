<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'author', 'coverPhoto', 'content','ageLimit', 'rating', 'numOfRates',
    ];

    public function owners() {
        return $this->belongsToMany(User::class)->withTimestamps();;
    }

    public function ratings() {
        return $this->hasMany(Rating::class, 'book_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'book_id');
    }
}
