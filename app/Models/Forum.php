<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Forum extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeWithFilter($query, Request $request)
    {
        return $query
            ->when($request->query('sort'), function ($query, $sort){
                $sortDirection = str_starts_with($sort, '-') ? 'DESC' : 'ASC';
                $sort = str_replace('-','', $sort);
                switch ($sort){
                    case 'active':
                        $activeSort = $this->commentsSortIds('catalogs', 'App\Models\Forum');

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

    public function getDate()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i:s');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
