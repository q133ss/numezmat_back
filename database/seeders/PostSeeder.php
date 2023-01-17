<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newsText = 'С 1 февраля 2021 года выпускают монеты «50-летие Международной организации Франкофонии» («50 years since the establishment of the Organisation internationale de la Francophonie»:

    50 бани – недрагоценный металл ((Cu80Zn15Ni5); 10 леев – драгоценный сплав (серебро 999 пробы).

Дизайн монет идентичен. 

На аверсе находится логотип Международной организации Франкофонии (International Organization of La Francophonie) – объединения 58 франкоязычных стран мира. Члены объединения нацелены на сотрудничество в различных областях: культура, экология, права человека, многообразие культур и этнических меньшинств. В 2006 году Румыния принимала 11-й саммит организации, тематикой которого были «Образование и новые информационные технологии» (Бухарест). Вверху по окружности указывают эмитента – «ROMANIA». По центру расположили номинал («10 lei» или «50 bani»). В нижней части находится год выпуска – 2020. 

На реверсе расположили изображение земного шара, символизирующего универсальность французского языка. По окружности прописывают памятное событие – «50 DE ANI DE LA INFIINTAREA ORGANIZATIEI INTERNATIONALE A FRANCOFONIEI». 

Технические характеристики 10 леев Румынии «50 лет Международной организации Франкофонии»

    Материал – серебро 999 пробы; размер – 37 мм; масса – 31,103 г.; качество – пруф; тираж – 500 штук.

Особенности 50 бани Румынии 

    Материал – недрагоценный сплав (Cu80Zn15Ni5); размер – 23,75 мм; масса – 6,1 г.; качество – пруф; тираж – 5 000 штук.

Цена 10 леев «50 years since the establishment of the Organisation internationale de la Francophonie» - 350 леев (поставляется с сертификатом подлинности). Монету из недрагоценных металлов можно купить за 10 лей.';

        $news = [
            [
                'title' => '50 лет Международной организации Франкофонии на 50 бани и 10 леях Румынии',
                'except' => 'С 1 февраля 2021 года выпускают монеты «50-летие Международной организации Франкофонии» («50 years since the establishment of the Organisation internationale de la Francophonie»',
                'description' => $newsText
            ],
            [
                'title' => '25 евро Австрии: транспорт будущего на монете «Умная мобильность» («Smart mobility»)',
                'except' => 'С 1 февраля 2021 года выпускают монеты «50-летие Международной организации Франкофонии» («50 years since the establishment of the Organisation internationale de la Francophonie»',
                'description' => $newsText
            ],
            [
                'title' => 'Национальный исторический парк в Опустасере (Opusztaszer) на 2 000 форинтов Венгрии',
                'except' => 'С 1 февраля 2021 года выпускают монеты «50-летие Международной организации Франкофонии» («50 years since the establishment of the Organisation internationale de la Francophonie»',
                'description' => $newsText
            ]
        ];

        foreach ($news as $post) {
            $news = News::create($post);

            $file = new File();
            $file->morphable_type = 'App\Models\News';
            $file->morphable_id = $news->id;
            $file->src = '/assets/img/news1.png';
            $file->category = 'img';
            $file->save();
        }
    }
}
