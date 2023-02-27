<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getType()
    {
        switch ($this->type){
            case 'here':
                return 'Только на одной странице';
            case 'all':
                return 'Во всей категории';
            default:
                return '';
        }
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getCategory()
    {
        switch ($this->category){
            case 'news':
                return 'Новости';
            case 'rating':
                return 'Определение и оценка';
            case 'expertise':
                return 'Экспертиза';
            case 'catalog':
                return 'Каталог';
            case 'shop':
                return 'Магазин';
            case 'library':
                return 'Библиотека';
            case 'forum':
                return 'Беседка';
            default:
                return 'Отсутсвует';
        }
    }
}
