<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'coverPhoto',
        'ageLimit',
        'rating',
        'numOfRates',
        'creator_id',
        'node_id'
    ];

    public function node() {
        return $this->hasOne(Node::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function owners() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function ratings() {
        return $this->hasMany(StoryRating::class);
    }

    public function comments() {
        return $this->hasMany(StoryComment::class);
    }
}
