<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ads()
    {
        return $this->hasMany(Ad::class, 'id', 'ad_id');
    }

    public static function getAds($count = 2)
    {
        //делаем 2 квери

        //еще на на категорию
        $query_cat = self::join('ads', 'ads.id', 'ads_orders.ad_id')
            ->where('category', stristr(\Request::route()->getName(),'.', true))
            ->where('active', true)
            ->where('last_date' , '>', now())
            ->orderBy('ads_orders.last_date', 'ASC')
            ->limit($count);

        $query_url = self::join('ads', 'ads.id', 'ads_orders.ad_id')
            ->where('page_url', url()->current())
            ->where('active', true)
            ->where('last_date' , '>', now())
            ->orderBy('ads_orders.last_date', 'ASC')
            ->limit($count);

        //нихуя
        //их может быть 2
        //одна на всю, другая на конкретную
        //и шо делать...
        return $query_url->exists() ? $query_url->get() : $query_cat->get();
    }
}
