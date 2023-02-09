<?php
namespace App\Traits;

trait CommentsSort{
    public function commentsSortIds(string $table, string $type)
    {
        $itemsWithComments = $this->leftJoin('comments', 'comments.morphable_id', $table.'.id')
            ->where('comments.morphable_type', $type)
            ->orderBy('comments.created_at', 'DESC')
            ->select($table.'.*');

        $itemsWithNoComments = $this->whereNotIn('id', $itemsWithComments->pluck('id')->all())
            ->where('category_id', $itemsWithComments->pluck('category_id')->first())
            ->get();

        return $itemsWithComments->get()->merge($itemsWithNoComments)->pluck('id')->all();
    }
}
