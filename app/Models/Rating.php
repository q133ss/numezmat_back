<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function comments()
    {
        return $this->morphMany(Comment::class, 'morphable')->where('reply_id', null);
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
                })
                ->when($request->query('sort'), function ($query, $sort){
                    $sortDirection = str_starts_with($sort, '-') ? 'DESC' : 'ASC';
                    $sort = str_replace('-','', $sort);
                    switch ($sort){
                        case 'active':
                            $query->with('comments', function ($query) use ($sortDirection){
                                $query->orderBy('created_at', 'ASC');
                            });
                            break;
                        case 'date':
                            $query->orderBy('created_at', $sortDirection);
                            break;
                    }
                });
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getDate()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i:s');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function relatedPosts($count = 4)
    {
        return $this->where('id', '!=', $this->id)->where('is_block', false)->limit($count)->get();
    }

}
