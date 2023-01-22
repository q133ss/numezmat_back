<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsOrder extends Model
{
    use HasFactory;

    public function ads()
    {
        return $this->hasMany(Ad::class, 'id', 'ad_id');
    }

    public static function getAds($count = 2)
    {
        $query = self::join('ads', 'ads.id', 'ads_orders.ad_id')
            ->where('page_url', url()->current())
            ->where('active', true)
            ->orderBy('ads_orders.last_date', 'ASC')
            ->limit($count)
            ->get();

        return $query;
    }
}
