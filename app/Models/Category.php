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

    /**
     * @param string $type
     * @param $model
     * @return array
     * Да да, это лучшая сортировка на свете :)
     */
    public function activeSort(string $type, $model) : array
    {
        $cats_ids = [];
        //берем главные категории
        $cats_ids[] = $this->getMainCategories($type)->pluck('id')->all();

        while($this->whereIn('parent_id', last($cats_ids))->exists()){
            $ids = $this->whereIn('parent_id', last($cats_ids))->pluck('id')->all();
            $cats_ids[] = $ids;
        }

        ///
        $ids_formatted = [];

        array_walk_recursive($cats_ids, function ($item, $key) use (&$ids_formatted) {
            $ids_formatted[] = $item;
        });

        //тут у нас есть абсалютно все категории
        //теперь ищем все айтемы у которых катеогория одна из этих
//        $items = Rating::whereIn('category_id', $ids_formatted)->pluck('id')->all();
        $items = $model::whereIn('category_id', $ids_formatted)->pluck('id')->all();

        $comments = Comment::whereIn('morphable_id',$items)
            ->where('morphable_type', $type)
            ->orderBy('created_at', 'DESC')
            ->pluck('morphable_id')->all();

        $sortItems = []; //категории отсортированные
        foreach ($comments as $comment){
            $sortItems[] = $model::where('id', $comment)->pluck('category_id')->first();
        }
        //теперь у нас есть отсортированные подкатегории.
        //теперь нужно найти их родительские в нужном порядке

        //изначально было 1 2 3 по категориям
        $sortMainCategories = []; //отсортированные главные категории!
        foreach ($sortItems as $cat){
            if($this->find($cat)->getParents()->isEmpty()){
                $sortMainCategories[] = $cat;
            }else{
                $sortMainCategories[] = $this->find($cat)->getParents()->pluck('id')->first();
            }
        }
        //array_unique($sortMainCategories) теперь сюда добавляем все остальные, где ид != тем что уже есть и фсе
        $other_cats = self::getMainCategories($type)
            ->whereNotIn('id', array_unique($sortMainCategories))
            ->pluck('id')->all();

        return array_merge($sortMainCategories, $other_cats);
    }

    public function scopeWithOrder($query, $request, $table, $type, $model)
    {
        return $query->when($request->query('sort'), function ($query, $sort) use ($table, $type, $model){
            $sortDirection = str_starts_with($sort, '-') ? 'ASC' : 'DESC';
            $sort = str_replace('-','', $sort);
            switch ($sort){
                case 'date':
                    $query->orderBy('created_at', $sortDirection);
                    break;

                case 'active':
                    $activeSort = $this->activeSort($type, $model);
                    if(!empty($activeSort)) {
                        $str = implode(",", $this->activeSort($type, $model));
                        $query->orderByRaw("FIELD(id, $str)");
                    }
                    break;
            }
        });
    }
}
