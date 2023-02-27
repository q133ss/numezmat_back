<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $guarded = [];

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

    public function getCategory()
    {
        switch ($this->category_type){
            case 'news':
                return 'Новости';
            case 'rating':
                return 'Определение и оценка';
            case 'expertise':
                return 'Экспертиза';
            case 'catalog':
                return 'Каталог';
            case 'shop':
                return 'Магазин';
            case 'library':
                return 'Библиотека';
            case 'forum':
                return 'Беседка';
            default:
                return 'Отсутсвует';
        }
    }

    public function order()
    {
        return $this->hasOne(AdsOrder::class, 'ad_id', 'id');
    }

    public function getLastDate()
    {
        if($this->order != null) {
            return $this->order->pluck('last_date')->first();
        }else{
            return '';
        }
    }
}
