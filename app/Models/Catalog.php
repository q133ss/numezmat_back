<?php

namespace App\Models;

use App\Traits\CommentsSort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Catalog extends Model
{
    use HasFactory, CommentsSort;

    protected $guarded = [];

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
            })
            ->when($request->query('sort'), function ($query, $sort){
                $sortDirection = str_starts_with($sort, '-') ? 'DESC' : 'ASC';
                $sort = str_replace('-','', $sort);
                switch ($sort){
                    case 'active':
                        $activeSort = $this->commentsSortIds('catalogs', 'App\Models\Catalog');

                        if(!empty($activeSort)) {
                            $str = implode(",", $activeSort);
                            $query->orderByRaw("FIELD(id, $str)");
                        }
                        break;
                    case 'date':
                        $query->orderBy('created_at', $sortDirection);
                        break;
                }
            });
    }

    public function img()
    {
        return $this->morphOne(File::class, 'morphable')->where('category','img')->orderBy('created_at','DESC')->pluck('src')->first();
    }

    public function images()
    {
        return $this->morphMany(File::class, 'morphable')->where('category', 'img')->pluck('src')->all();
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function relatedPosts($count = 4)
    {
        return $this->where('id', '!=', $this->id)->where('is_block', false)->limit($count)->get();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'morphable')->where('reply_id', null);
    }
}
