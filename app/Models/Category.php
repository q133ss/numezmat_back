<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static function getMainCategories($type)
    {
        return self::where('type', $type)->where('parent_id', null);
    }

    public static function getSubCategories($type, $parent_id)
    {
        return self::where('type', $type)->where('parent_id', $parent_id);
    }

    public static function getItems($table, $parent_id)
    {
        return self::join($table, $table.'.category_id', 'categories.id')->where($table.'.category_id', $parent_id);
    }

    public function getParents()
    {
        $ids = [];
        $ids[] = $this->parent_id;

        while (true){

            try {
                $parent = $this->find(last($ids))->parent_id;
            }catch(\Exception $exception){
                break;
            }

            if($parent != null) {
                $ids[] = $parent->id;
            }else{
                break;
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

    public function getFiltersForRating()
    {
        return $this->join('filters', 'filters.category_id', 'categories.id')
            ->where('filters.type', 'App\Models\Rating')
            ->get();
    }

    //получает значения фильтров
    public function getFilterValuesForRating($field)
    {
        return $this->join('ratings', 'ratings.category_id', 'categories.id')
            ->join('characteristics', 'characteristics.morphable_id', 'ratings.id')
            ->where('characteristics.morphable_type', 'App\Models\Rating')
            ->where('characteristics.key', $field)
            ->pluck('characteristics.value')
            ->all();
    }
}
