<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Expertise;
use App\Models\File;
use App\Models\News;
use App\Models\Rating;
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

        //Rating seeder
        //category
        $categories = [
            ['name' => 'Монеты на оценку', 'description' => 'Оценка любых монет'],
            ['name' => 'Монеты СССР', 'description' => 'Оценка монет СССР'],
            ['name' => 'Оценка монет СНГ', 'description' => 'В этом разделе можно оценить монеты из СНГ'],
            ['name' => 'Оценка иностранных монет', 'description' => 'В этом разделе можно оценить иностранную монету']
        ];

        foreach ($categories as $category){
            $category['type'] = 'App\Models\Rating';
            Category::create($category);
        }
        //Subcategory
        $coins = Category::where('name','Монеты на оценку')->pluck('id')->first();
        $sng = Category::where('name', 'Оценка монет СНГ')->pluck('id')->first();
        $foreign = Category::where('name', 'Оценка иностранных монет')->pluck('id')->first();

        $subcats = [
            ['name' => 'Монеты РФ', 'description' => 'Оценка монет из РФ', 'parent_id' => $sng],
            ['name' => 'Монеты Казахстан', 'description' => 'Оценка монет из казахстана', 'parent_id' => $sng],
            ['name' => 'Монеты Грузия', 'description' => 'Оценка грузинских монет', 'parent_id' => $sng],

            ['name' => 'Английские монеты', 'description' => 'Оценка монет из Англии', 'parent_id' => $foreign]
        ];

        foreach ($subcats as $subcat){
            $subcat['type'] = 'App\Models\Rating';
            Category::create($subcat);
        }
        //Posts
        $rf = Category::where('name', 'Монеты РФ')->pluck('id')->first();
        $ratings = [
            ['title' => 'Оцените мою монету', 'description' => 'Нашел монету, какая примерная цена?', 'category_id' => $coins],
            ['title' => '10 копеек', 'description' => '10 копеек, год не знаю', 'category_id' => $coins],
            ['title' => '20 руб 1992', 'description' => 'Что скажите?', 'category_id' => $coins],

            ['title' => '1 копейка 1798', 'description' => 'Оцените пожалуйста', 'category_id' => $rf],
            ['title' => '3 копейки 1956', 'description' => 'Что скажите?', 'category_id' => $rf],
        ];

        foreach ($ratings as $rating){
            $rating['user_id'] = 1;
            Rating::create($rating);
        }

        //Img for cats
        $ussr = Category::where('name', 'Монеты СССР')->pluck('id')->first();

        $kz = Category::where('name', 'Монеты Казахстан')->pluck('id')->first();
        $gr = Category::where('name', 'Монеты Грузия')->pluck('id')->first();
        $eng = Category::where('name', 'Английские монеты')->pluck('id')->first();

        $imgs = [
            ['morphable_type' => 'App\Models\Category', 'morphable_id' => $coins, 'src' => '/assets/img/just-coin.jpg', 'category' => 'img'],
            ['morphable_type' => 'App\Models\Category', 'morphable_id' => $ussr, 'src' => '/assets/img/just-penny.jpg', 'category' => 'img'],
            ['morphable_type' => 'App\Models\Category', 'morphable_id' => $sng, 'src' => '/assets/img/sng.jpg', 'category' => 'img'],
            ['morphable_type' => 'App\Models\Category', 'morphable_id' => $foreign, 'src' => '/assets/img/foreign.jpg', 'category' => 'img'],

            ['morphable_type' => 'App\Models\Category', 'morphable_id' => $rf, 'src' => '/assets/img/just-rub.jpg', 'category' => 'img'],
            ['morphable_type' => 'App\Models\Category', 'morphable_id' => $kz, 'src' => '/assets/img/just-rub.jpg', 'category' => 'img'],
            ['morphable_type' => 'App\Models\Category', 'morphable_id' => $gr, 'src' => '/assets/img/just-rub.jpg', 'category' => 'img'],
            ['morphable_type' => 'App\Models\Category', 'morphable_id' => $eng, 'src' => '/assets/img/just-rub.jpg', 'category' => 'img']
        ];

        //create files

        foreach ($imgs as $img){
            File::create($img);
        }

        foreach (Rating::all() as $rating){
            File::create(
                [
                    'morphable_type' => 'App\Models\Rating',
                    'morphable_id' => $rating->id,
                    'src' => '/assets/img/just-rub.jpg',
                    'category' => 'img'
                ]
            );
        }

        $postImgs = ['/assets/img/sng.jpg', '/assets/img/foreign.jpg', '/assets/img/just-coin.jpg', '/assets/img/just-penny.jpg'];

        foreach ($postImgs as $img){
            File::create(
                [
                    'morphable_type' => 'App\Models\Rating',
                    'morphable_id' => 1,
                    'src' => $img,
                    'category' => 'img'
                ]
            );
        }

        //characteristics
        $characteristics = [
            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '2',
                'key' => 'condition',
                'value' => 'Удовлетворительое'
            ],

            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '3',
                'key' => 'year',
                'value' => '1992'
            ],
            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '3',
                'key' => 'condition',
                'value' => 'Удовлетворительое'
            ],

            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '4',
                'key' => 'condition',
                'value' => 'Удовлетворительое'
            ],
            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '4',
                'key' => 'year',
                'value' => '1798'
            ],

            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '5',
                'key' => 'condition',
                'value' => 'Новое'
            ],
            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '5',
                'key' => 'year',
                'value' => '1956'
            ],
        ];

        foreach ($characteristics as $characteristic){
            Characteristic::create($characteristic);
        }

        //Expertise categories
        $expertise_categories = [
            ['name' => 'Монеты СССР', 'description' => 'Экспертиза монет из СССР'],
            ['name' => 'Монеты РФ', 'description' => 'Экспертиза монет из РФ'],
        ];

        foreach ($expertise_categories as $category){
            $category['type'] = 'App\Models\Expertise';
            Category::create($category);
        }

        //Experise subcats
            $cat_type = 'App\Models\Expertise';
        Category::create(['name' => 'Подкатегория 1', 'description' => 'Экспетира монет подкатегория 1', 'type' => $cat_type, 'parent_id' => Category::where('name', 'Монеты РФ')->where('type', 'App\Models\Expertise')->pluck('id')->first()]);
        Category::create(['name' => 'Подкатегория 2', 'description' => 'Экспетира монет подкатегория 2', 'type' => $cat_type, 'parent_id' => Category::where('name', 'Подкатегория 1')->where('type', 'App\Models\Expertise')->pluck('id')->first()]);
        Category::create(['name' => 'Подкатегория 3', 'description' => 'Экспетира монет подкатегория 3', 'type' => $cat_type, 'parent_id' => Category::where('name', 'Подкатегория 2')->where('type', 'App\Models\Expertise')->pluck('id')->first()]);
        Category::create(['name' => 'Подкатегория 4', 'description' => 'Экспетира монет подкатегория 4', 'type' => $cat_type, 'parent_id' => Category::where('name', 'Подкатегория 3')->where('type', 'App\Models\Expertise')->pluck('id')->first()]);
        Category::create(['name' => 'Подкатегория 5', 'description' => 'Экспетира монет подкатегория 5', 'type' => $cat_type, 'parent_id' => Category::where('name', 'Подкатегория 4')->where('type', 'App\Models\Expertise')->pluck('id')->first()]);

        //Experise cats img
        $expertise_img = [
            ['name' => 'Монеты СССР', 'src' => '/assets/img/just-rub.jpg'],
            ['name' => 'Монеты РФ', 'src' => '/assets/img/just-coin.jpg']
        ];

        for($i = 1; $i <= 5; $i++){
            array_push($expertise_img, ['name' => 'Подкатегория '.$i, 'src' => '/assets/img/just-coin.jpg']);
        }

        foreach ($expertise_img as $img){
            $img['morphable_type'] = 'App\Models\Category';
            $img['morphable_id'] = Category::where('type', 'App\Models\Expertise')->where('name', $img['name'])->pluck('id')->first();
            $img['category'] = 'img';
            unset($img['name']);
            File::create($img);
        }

        //Expertise posts
        $rf_expertise = Category::where('type', 'App\Models\Expertise')->where('name', 'Монеты РФ')->pluck('id')->first();
        $ussr_expertise = Category::where('type', 'App\Models\Expertise')->where('name', 'Монеты СССР')->pluck('id')->first();

        $expertises = [
            ['title' => 'Требуется экспертиза этой монеты', 'description' => 'Нашел монету, требуется экспертиза', 'category_id' => $rf_expertise],
            ['title' => '10 копеек', 'description' => 'Кто сможет помочь с экспертизой?', 'category_id' => $rf_expertise],
            ['title' => '20 руб 1998', 'description' => 'Необходимо провести экспертизу', 'category_id' => $rf_expertise],

            ['title' => '1 копейка 1978', 'description' => 'Нужна экспертиза', 'category_id' => $ussr_expertise],
            ['title' => '3 копейки 1956', 'description' => 'Что скажите?', 'category_id' => $ussr_expertise]
        ];

        foreach ($expertises as $expertise){
            $expertise['user_id'] = 1;
            $post = Expertise::create($expertise);

            File::create([
                'morphable_type' => 'App\Models\Expertise',
                'morphable_id' => $post->id,
                'category' => 'img',
                'src' => '/assets/img/just-coin.jpg'
            ]);
        }
    }
}
