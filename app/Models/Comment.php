<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'commentText',
    ];

    public function rated_by() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rated_on() {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
