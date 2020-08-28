<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function parentComments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function latestComment()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest()->first();
    }

}
