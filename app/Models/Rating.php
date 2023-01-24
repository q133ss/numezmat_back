<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class Rating extends Model
{
    use HasFactory;

    public static function isJoined($query, $table)
    {
        $joins = $query->getQuery()->joins;
        if($joins == null) {
            return false;
        }

        foreach ($joins as $join) {
            if ($join->table == $table) {
                return true;
            }
        }

        return false;
    }

    public function img()
    {
        return $this->morphOne(File::class, 'morphable')->where('category','img')->pluck('src')->first();
    }

    public function characteristics()
    {
        return $this->morphMany(Characteristic::class, 'morphable');
    }

    public function scopeWithFilter($query, Request $request)
    {
        return $query->when($request->query('year'), function ($query, $year){
                    $query->whereHas('characteristics', function ($q) use ($year){
                        $q->where('key', 'year')->where('value', $year);
                    });
                })
                ->when($request->query('condition'), function ($query, $condition){
                    $query->whereHas('characteristics', function ($q) use ($condition){
                        $q->where('key', 'condition')->where('value', $condition);
                    });
                });
    }

}
