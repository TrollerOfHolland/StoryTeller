<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id',
        'content',
        'parent_id',
        'option_one_id',
        'option_one_text',
        'option_two_id',
        'option_two_text',
        'option_three_id',
        'option_three_text',
        'end'
    ];
    public function parent() {
        return $this->hasOne(Node::class, 'parent_id');
    }
    public function option_one() {
        return $this->hasOne(Node::class, 'option_one_id');
    }
    public function option_two() {
        return $this->hasOne(Node::class, 'option_two_id');
    }
    public function option_three() {
        return $this->hasOne(Node::class, 'option_three_id');
    }

}
