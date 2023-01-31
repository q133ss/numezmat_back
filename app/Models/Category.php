<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getMainCategories($type)
    {
        return self::where('categories.type', $type)->where('categories.parent_id', null);
    }

    public static function getSubCategories($type, $parent_id, $limit = 10000)
    {
        return self::where('type', $type)->where('parent_id', $parent_id)->limit($limit);
    }

    public static function getItems($table, $parent_id)
    {
        return self::join($table, $table.'.category_id', 'categories.id')->where($table.'.category_id', $parent_id);
    }

    public function getParents()
    {
        $ids = [];
        if($this->parent_id != null) {
            $ids[] = $this->parent_id;
            while (true) {
                $lastItem = $this->find(last($ids))->toArray();
                if($lastItem['parent_id'] != null) {
                    $ids[] = $lastItem['parent_id'];
                }else{
                    break;
                }
            }
        }
        return $this->whereIn('id', $ids)->get();
    }

    public function date()
    {
        return Carbon::parse($this->created_at)->format('d m Y H:i');
    }

    public function img()
    {
        return $this->morphOne(File::class, 'morphable')->where('category', 'img')->pluck('src')->first();
    }

    public function addView()
    {
        $this->views_count = $this->views_count + 1;
        $this->save();

        return true;
    }

    public function getFilters($type)
    {
        return $this->join('filters', 'filters.category_id', 'categories.id')
            ->where('filters.type', $type)
            ->where('filters.category_id', $this->id)
            ->get();
    }

    //получает значения фильтров
    public function getFilterValuesForRating($field)
    {
        return $this->join('ratings', 'ratings.category_id', 'categories.id')
            ->where('ratings.category_id', $this->id)
            ->join('characteristics', 'characteristics.morphable_id', 'ratings.id')
            ->where('characteristics.morphable_type', 'App\Models\Rating')
            ->where('characteristics.key', $field)
            ->pluck('characteristics.value')
            ->all();
    }

    public function getFilterValues($table, $type, $field)
    {
        return $this->join($table, $table.'.category_id', 'categories.id')
            ->where($table.'.category_id', $this->id)
            ->join('characteristics', 'characteristics.morphable_id', $table.'.id')
            ->where('characteristics.morphable_type', $type)
            ->where('characteristics.key', $field)
            ->pluck('characteristics.value')
            ->all();
    }

    public function scopeWithOrder($query, $request, $table, $type)
    {
        return $query->when($request->query('sort'), function ($query, $sort) use ($table, $type){
            $sortDirection = str_starts_with($sort, '-') ? 'ASC' : 'DESC';
            $sort = str_replace('-','', $sort);
            switch ($sort){
                case 'active':
                    #TODO НАМ НУЖНО КАК-ТО НАЙТИ КАТЕГОРИЮ ПО ПАРЕНТУ ИЗ ЭТОГО ЗАПРОСА
                    #И ОТСОРТИРОВАТЬ ЕЕ
//                   $query = $this->where('type', $type)
//                       ->leftJoin($table, $table.'.category_id', 'categories.id')
//                       ->leftJoin('comments', 'comments.morphable_id', $table.'.id')
//                       ->where('comments.morphable_type', 'App\Models\Rating')
//                       ->orderBy('comments.created_at', $sortDirection)
//                       //найдем ту, где максимальная дата коммента, потом ее парент
//                       ->select('categories.*');
                    break;
                case 'date':
                    $query->orderBy('created_at', $sortDirection);
                    break;
            }
        });
    }
}
