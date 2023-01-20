<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function img()
    {
        return $this->morphOne(File::class, 'morphable')->where('category', 'img')->pluck('src')->first();
    }

    public function file()
    {
        return $this->morphOne(File::class, 'morphable');
    }

    public function relatedPosts()
    {
        return $this->where('id', '!=', $this->id)->where('is_block', false)->limit(3)->get();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'morphable')->where('reply_id', null);
    }
}
