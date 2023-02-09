<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function img()
    {
        return $this->morphOne(File::class, 'morphable')
            ->where('category', 'img')
            ->pluck('src')
            ->first();
    }
}
