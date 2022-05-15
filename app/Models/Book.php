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
        'title', 'author', 'coverPhoto', 'content','ageLimit', 'rating', 'numOfRates', 'author_id',
    ];

    public function owners() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
