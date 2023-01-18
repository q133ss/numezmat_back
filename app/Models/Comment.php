<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function replies()
    {
        return $this->where('reply_id', $this->id);
    }

    /*
     * Автор коммента, на который мы отвечаем
     */
    public function replyAuthor()
    {
        return $this->find($this->reply_id)->author->name;
    }

    public function coin()
    {
        return $this->hasOne(Coin::class, 'id', 'coin_id');
    }
}
