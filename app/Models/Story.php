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
    ];

    public function node() {
        return $this->hasOne(Node::class);
    }

    public function owners() {
        return $this->belongsToMany(User::class)->withTimestamps();;
    }
}
