<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permission();
        $manageUser->name = 'Просмотр страницы "Новости"';
        $manageUser->slug = 'view-news';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Просмотр страницы "Определение и оценка"';
        $manageUser->slug = 'view-rating';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Просмотр страницы "Экспертиза"';
        $manageUser->slug = 'view-expertise';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Просмотр страницы "Каталог"';
        $manageUser->slug = 'view-catalog';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Просмотр страницы "Магазин"';
        $manageUser->slug = 'view-shop';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Просмотр страницы "Библиотека"';
        $manageUser->slug = 'view-library';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Просмотр страницы "Беседка"';
        $manageUser->slug = 'view-forum';
        $manageUser->save();

        //News actions
        $manageUser = new Permission();
        $manageUser->name = 'Редактировать новости';
        $manageUser->slug = 'edit-news';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Блокировать новости';
        $manageUser->slug = 'block-news';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Добавлять новости';
        $manageUser->slug = 'create-news';
        $manageUser->save();

        //Rating actions
        $manageUser = new Permission();
        $manageUser->name = 'Добавлять записи в "Определение и оценка"';
        $manageUser->slug = 'create-rating';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Изменять записи в "Определение и оценка"';
        $manageUser->slug = 'edit-rating';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Блокировать и удалять записи в "Определение и оценка"';
        $manageUser->slug = 'block-rating';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Добавлять разделы в "Определение и оценка"';
        $manageUser->slug = 'create-sections-rating';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Изменять разделы в "Определение и оценка"';
        $manageUser->slug = 'edit-sections-rating';
        $manageUser->save();

        $manageUser = new Permission();
        $manageUser->name = 'Удалять разделы в "Определение и оценка"';
        $manageUser->slug = 'delete-sections-rating';
        $manageUser->save();
    }
}
