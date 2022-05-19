<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'story_id',
        'rating',
    ];

    public function rated_by() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rated_on() {
        return $this->belongsTo(Book::class, 'story_id');
    }
}
