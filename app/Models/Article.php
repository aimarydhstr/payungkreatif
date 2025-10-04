<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    protected $fillable = [
        'author_id', 'category_id', 'title', 'slug', 'thumbnail', 'body',
        'is_featured', 'status', 'published_at',
        'meta_title', 'meta_description'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail 
            ? asset('storage/'.$this->thumbnail) 
            : asset('images/no-thumbnail.jpg'); // fallback image
    }

    protected static function booted()
    {
        static::deleting(function ($article) {
            if ($article->thumbnail && Storage::disk('public')->exists('uploads/'.$article->thumbnail)) {
                Storage::disk('public')->delete('uploads/'.$article->thumbnail);
            }
        });
    }
}
