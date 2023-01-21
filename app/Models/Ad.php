<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    public function img()
    {
        $img = $this->morphOne(File::class, 'morphable')
            ->where('category', 'ads')
            ->pluck('src')->first();
        if(!$img){
            return public_path().'/assets/img/ads.jpg';
        }
        return $img;
    }
}
