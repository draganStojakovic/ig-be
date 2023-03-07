<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_urls',
        'user_id',
    ];

    protected $casts = ['image_urls' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'post_id', 'user_id');
    }

    public static function search($term)
    {
        return self::with('user')
            ->where('title', 'LIKE', '%' . $term . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public static function searchUserPosts($term, $userId)
    {
        return self::where('title', 'LIKE', '%' . $term . '%')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
