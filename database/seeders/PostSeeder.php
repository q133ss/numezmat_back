<?php

namespace Database\Seeders;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Expertise;
use App\Models\File;
use App\Models\Library;
use App\Models\News;
use App\Models\Product;
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
                'name' => 'Состояние',
                'key' => 'condition',
                'value' => 'Удовлетворительое'
            ],

            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '3',
                'name' => 'Год',
                'key' => 'year',
                'value' => '1992'
            ],
            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '3',
                'name' => 'Состояние',
                'key' => 'condition',
                'value' => 'Удовлетворительое'
            ],

            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '4',
                'name' => 'Состояние',
                'key' => 'condition',
                'value' => 'Удовлетворительое'
            ],
            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '4',
                'name' => 'Год',
                'key' => 'year',
                'value' => '1798'
            ],

            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '5',
                'name' => 'Состояние',
                'key' => 'condition',
                'value' => 'Новое'
            ],
            [
                'morphable_type' => 'App\Models\Rating',
                'morphable_id' => '5',
                'name' => 'Год',
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

        //Catalog

        $catalog_cats = [
            ['name' => 'Монеты РФ', 'description' => 'Монеты РФ'],
            ['name' => 'Монеты СНГ', 'description' => 'Монеты СНГ'],
        ];

        foreach ($catalog_cats as $cat){
            $cat['type'] = 'App\Models\Catalog';
            $category = Category::create($cat);
        }

        $catalog_subcats = [
            ['name' => 'До революции', 'description' => 'Монеты до революции'],
            ['name' => 'После революции', 'description' => 'Монеты после революции'],
            ['name' => 'Монеты СССР', 'description' => 'Монеты СССР'],
            ['name' => 'Монеты РФ', 'description' => 'Каталог монет РФ']
        ];

        foreach ($catalog_subcats as $cat){
            $cat['parent_id'] = Category::where('name', 'Монеты РФ')->where('type', 'App\Models\Catalog')->pluck('id')->first();
            $cat['type'] = 'App\Models\Catalog';
            Category::create($cat);
        }

        foreach (Category::where('type', 'App\Models\Catalog')->get() as $cat) {
            File::create([
                'morphable_type' => 'App\Models\Category',
                'morphable_id' => $cat->id,
                'src' => '/assets/img/just-rub.jpg',
                'category' => 'img'
            ]);
        }

        $catalog_posts = [
            [
                'title' => '2 рубля 1725 года',
                'description' => 'В центре изображён Святой апостол Андрей Первозванный несущий крест. Под ним - полоса земли. Вокруг изображения, обращенная внутрь, надпись: «МОНЕТА НОВА ЦЕНА ДВА РУБЛI 1725». Полоса земли делит год выпуска (17-25).',
                'category_id' => Category::where('type', 'App\Models\Catalog')->where('name', 'До революции')->pluck('id')->first()
            ],
            [
                'title' => '1 рубль 1725 года',
                'description' => 'В центре профильный портрет вправо императора Петра I, увенчанный лавровым венком. Вокруг портрета надпись: «ПЕТРЪ А ИМПЕРАТОРЪ IСАМОДЕРЖЕЦЪ ВСЕРОССIИСКIИ». По окружности канта - витой ободок.',
                'category_id' => Category::where('type', 'App\Models\Catalog')->where('name', 'До революции')->pluck('id')->first()
            ]
        ];

        foreach ($catalog_posts as $post){
            $catalog = Catalog::create($post);
            File::create([
                'morphable_type' => 'App\Models\Catalog',
                'morphable_id' => $catalog->id,
                'src' => '/assets/img/just-rub.jpg',
                'category' => 'img'
            ]);
        }

        //Characteristics !!!!!!!!
        $characteristic_catalog = [
            ['name' => 'Страна', 'key' => 'country', 'value' => 'Россия'],
            ['name' => 'Тип', 'key' => 'type', 'value' => 'Юбилейная или памятная'],
            ['name' => 'Год', 'key' => 'year', 'value' => '2020 г.'],
            ['name' => 'Номинал', 'key' => 'denomination', 'value' => '25 рублей.'],
            ['name' => 'Диаметр (мм)', 'key' => 'diameter', 'value' => '27'],
            ['name' => 'Тираж (шт)', 'key' => 'circulation', 'value' => '5 000 000'],
            ['name' => 'Материал', 'key' => 'material', 'value' => 'Мельхиор'],
            ['name' => 'Толщина (мм)', 'key' => 'thickness', 'value' => '2,3 мм'],
            ['name' => 'Вес монеты (г)' ,'key' => 'weight', 'value' => '10']
        ];

        foreach ($characteristic_catalog as $char){
            $char['morphable_type'] = 'App\Models\Catalog';
            $char['morphable_id'] = Catalog::where('title', '2 рубля 1725 года ')->pluck('id')->first();
            Characteristic::create($char);
        }

        //Shop cats
        $shop_cats = [
            ['name' => 'Аксессуары', 'description' => 'Аксессуары'],
            ['name' => 'Прочее', 'description' => 'Прочее']
        ];

        foreach ($shop_cats as $cat){
            $cat['type'] = 'App\Models\Shop';
            Category::create($cat);
        }

        $shop_subs = [
            ['name' => 'Альбомы', 'parent_id' => Category::where('type', 'App\Models\Shop')->where('name', 'Аксессуары')->pluck('id')->first()],
            ['name' => 'Весы', 'parent_id' => Category::where('type', 'App\Models\Shop')->where('name', 'Аксессуары')->pluck('id')->first()],
            ['name' => 'Кофры/Боксы', 'parent_id' => Category::where('type', 'App\Models\Shop')->where('name', 'Аксессуары')->pluck('id')->first()],
            ['name' => 'Оптика', 'parent_id' => Category::where('type', 'App\Models\Shop')->where('name', 'Аксессуары')->pluck('id')->first()],

            ['name' => 'Лупы', 'parent_id' => Category::where('type', 'App\Models\Shop')->where('name', 'Прочее')->pluck('id')->first()],
            ['name' => 'Пинцеты', 'parent_id' => Category::where('type', 'App\Models\Shop')->where('name', 'Прочее')->pluck('id')->first()],
        ];

        foreach ($shop_subs as $cat){
            $cat['type'] = 'App\Models\Shop';
            Category::create($cat);
        }

        foreach (Category::where('type', 'App\Models\Shop')->get() as $cat) {
            File::create([
                'morphable_type' => 'App\Models\Category',
                'morphable_id' => $cat->id,
                'src' => '/assets/img/just-rub.jpg',
                'category' => 'img'
            ]);
        }

        $products = [
            ['title' => 'Альбом', 'description' => 'Альбом для монет', 'price' => '1299', 'category_id' => Category::where('name', 'Альбомы')->where('type', 'App\Models\Shop')->pluck('id')->first()],
            ['title' => 'Альбом для монет', 'description' => 'Альбом для монет', 'price' => '1599', 'category_id' => Category::where('name', 'Альбомы')->where('type', 'App\Models\Shop')->pluck('id')->first()],

            ['title' => 'Весы', 'description' => 'Весы для монет', 'price' => '2599', 'category_id' => Category::where('name', 'Весы')->where('type', 'App\Models\Shop')->pluck('id')->first()],

            ['title' => 'Лупа', 'description' => 'Лупа ', 'price' => '1200', 'category_id' => Category::where('name', 'Лупы')->where('type', 'App\Models\Shop')->pluck('id')->first()],
            ['title' => 'Еще одна лупа', 'description' => 'Лупа ', 'price' => '1500', 'category_id' => Category::where('name', 'Лупы')->where('type', 'App\Models\Shop')->pluck('id')->first()]
        ];

        foreach ($products as $product){
            Product::create($product);
        }

        $imgs = [
            'just-coin.jpg',
            'just-penny.jpg',
            'just-rub.jpg'
        ];

        $product_charateristics = [
            [
                'name' => 'Страна',
                'key' => 'country',
                'value' => 'Россия'
            ],
            [
                'name' => 'Год',
                'key' => 'year',
                'value' => '2023'
            ],
            [
                'name' => 'Материал',
                'key' => 'material',
                'value' => 'Мельхиор'
            ],
            [
                'name' => 'Вес (г)',
                'key' => 'weight',
                'value' => '200'
            ]
        ];

        foreach (\App\Models\Product::get() as $product){
            File::create([
                'morphable_type' => 'App\Models\Product',
                'morphable_id' => $product->id,
                'src' => '/assets/img/'.$imgs[rand(0,2)],
                'category' => 'img'
            ]);

            foreach ($product_charateristics as $char){
                $char['morphable_type'] = 'App\Models\Product';
                $char['morphable_id'] = $product->id;
                Characteristic::create($char);
            }
        }


        //Library
        $lib_cats = [
            ['name' => 'Нумезматика', 'description' => 'Нумезматика'],
            ['name' => 'Бонистика', 'description' => 'Бонистика']
        ];
        foreach ($lib_cats as $cat){
            $cat['type'] = 'App\Models\Library';
            Category::create($cat);
        }

        $num_cat = Category::where('type', 'App\Models\Library')->where('name', 'Нумезматика')->pluck('id')->first();
        $bon_cat = Category::where('type', 'App\Models\Library')->where('name', 'Бонистика')->pluck('id')->first();

        $lib_sub_cats = [
            ['name' => 'Интересное', 'description' => 'Интересное о нумезматике', 'parent_id' => $num_cat],
            ['name' => 'Оценка', 'description' => 'Оценка монет', 'parent_id' => $num_cat],
            ['name' => 'Чистка монет', 'description' => 'Чистка монет', 'parent_id' => $num_cat],
            ['name' => 'Словарь', 'description' => 'Словарь для нумезматики', 'parent_id' => $num_cat],

            ['name' => 'Банкноты РФ', 'description' => 'Банкноты РФ', 'parent_id' => $bon_cat],
            ['name' => 'Банкноты США', 'description' => 'Банкноты США', 'parent_id' => $bon_cat],
        ];

        foreach ($lib_sub_cats as $cat){
            $cat['type'] = 'App\Models\Library';
            Category::create($cat);
        }

        foreach (Category::where('type', 'App\Models\Library')->get() as $cat){
            File::create([
                'morphable_type' => 'App\Models\Category',
                'morphable_id' => $cat->id,
                'src' => '/assets/img/'.$imgs[rand(0,2)],
                'category' => 'img'
            ]);
        }

        $descr = '
<p>Монеты являются, по сути, миниатюрами из металла. Одни страны изображают на них свои символы, особенно часто связанные с уникальной фауной и флорой, другие - исторических личностей. А 14 стран мира, в число которых входит теперь и Россия, выпустили монеты с железнодорожной тематикой. Острова Кайкос, Маршалловы острова и Куба являются в этом плане чемпионами. Каждая выпустила по 10 и более различных монет, на которых изображены старинные паровозы. Это неудивительно, так как именно островные государства чеканят самые разные монеты в расчете на коллекционеров всего мира, тем самым пополняя доходы собственной казны.
</p>
<p>Начнем с Кубы. 1 песо 1989 года из медно-никелевого сплава посвящен 160-летию первой в мире железной дороги Ливерпуль - Манчестер (1830 - 1990). На монете изображен паровоз Джефферсона. Этот же сюжет был ранее - в 1983 и 1988 годах - помещен на серебряных монетах в 10 и 20 песо. Они входили в серию из трех монет, посвященных историческим датам. Это уже упомянутое 160-летие Английских железных дорог, а также 150-летие первой железной дороги на Испанской Кубе и 140-летие первой железной дороги в Испании. На монетах изображены паровозы, первыми начавшие курсировать по этим трассам.
</p><p>
Вообще Кубинский монетный двор любит отмечать различные, даже некруглые даты. Один из поводов - ввод в эксплуатацию первых железных дорог в Европе. В 1996 году вышла серия серебряных монет по 10 песо. На монете с первым немецким локомотивом стоит дата "1835 год" - именно тогда началось железнодорожное движение в Германии. В Австрии - в 1848 году, и соответственно на второй монете - первый австрийский локомотив, в Швейцарии - на год раньше, и опять же на монете первый локомотив, прошедший по железной дороге альпийской республики.
</p>
Вне серий кубинцы выпустили в 1983-м серебряные 5 песо. На них изображен паровоз с выдающейся далеко вперед защитной решеткой - такие нам показывают в вестернах про покорение Дикого Запада.
<p>
Принадлежащие Великобритании вест-индские острова Кайкос в 1996 году выпустили серию из 10 серебряных монет номиналом по 20 долларов. На семи из них изображены знаменитые паровозы. "Сити оф Турбо", "Летящий шотландец", "Ракета" Джефферсона, "Утренняя звезда", "Миллард", "Принцесса Елизавета", "Саутерн Пасифик". Три монеты посвящены германским, японским и китайским железным дорогам.
</p>
Другие острова - Маршалловы - расположены в Тихом океане. Там в 1996 году были отчеканены 11 монет из латуни номиналом по 10 долларов. На всех помещены изображения знаменитых паровозов, водивших пассажирские экспрессы. Это "Пенсильвания К4", "Биг Бой", "DB класс 01", "RENEF класс 242", "FS группа 691", "SNCF 232.U1", "SAR класс 520", "Утренняя звезда", QJ "Advance Forward", "Royal Hudson" и С62 "Ласточка".
<p>
А вот Гибралтар - единственная страна, отметившая ввод в эксплуатацию железнодорожного туннеля под Ла-Маншем. Здесь в 1993 году были отчеканены медно-никелевые 2,8 ЭКЮ и серебряные 14 ЭКЮ, посвященные этому событию.
</p>
<p><p>
Наиболее интересную монету в 1984 году выпустил остров Мэн, расположенный в проливе, через который и проходит названный туннель. Это так называемая рождественская монета в 50 пенсов, которую каждый раз с новым рисунком чеканят к Рождеству. Рисунок всегда связан с прибытием Санта-Клауса с подарками на каком-либо виде транспорта. В 1984 году он приехал на старинном паровозе. Его встречают детишки, а над домами вьются дымки - все-таки зима.
</p>
<p><p>
На большинстве монет, отчеканенных в честь юбилеев железных дорог, помещают обычно старинные паровозы. А Швейцария 150-летие своих отметила серебряными 20 франками, на которых изображены колеса. На аверсе - колесо вагона, на реверсе - колесо паровоза с шатуном.
</p></<p>
Электровозы на своих монетах поместили Швейцария и Австрия. Первая - на монете, посвященной кантону Цюрих (50 франков, серебро, 2001 год). Вторая - на 500 шиллингах из серебра, отчеканенных в 1987 году также по случаю 150-летнего юбилея своих железных дорог. На аверсе монеты изображен электровоз, а уже под ним первый паровоз с прицепным тендером (преемственность).
</p>
Что касается изображения старинных паровозов на монетах, находившихся в регулярном обращении, то до этого додумалась только Бразилия. Это 200 рейсов выпуска 1936 - 1938 годов.
<p>
Обычно же с изображениями паровозов начала XX века выпускались юбилейные монеты, которые продаются выше номинала, обозначенного на них. К таковым следует отнести мексиканские 5 серебряных песо 1950 года. Повод чеканки - открытие Южной железной дороги. Поэтому паровоз мчится на фоне пальм и восходящего солнца.
</p><p>
Монголия - страна, через которую проходит железная дорога Москва - Пекин. И это отмечено на серебряной монете в 2500 тугриков 1995 года. На монете мы видим паровоз, ведущий состав через мост.
</p>
Россия отметила 100-летие Транссибирской магистрали выпуском серебряной монеты номиналом 3 рубля, а также серебряной и золотой номиналом 25 рублей. На трехрублевой изображены мост через Обь с проходящим по нему паровозом и схема магистрали от Челябинска до Владивостока. На серебряной в 25 рублей - укладка железнодорожного полотна и стоящий на готовом участке дороги состав. На золотой - паровоз, выходящий из туннеля. На всех трех монетах - герб Сибири и эмблема Министерства путей сообщения Российской империи - скрещенные якорь и топор.</p>';

        $inter = Category::where('name', 'Интересное')->where('type', 'App\Models\Library')->pluck('id')->first();
        $library_posts = [
            [
                'name' => 'Железная дорога на монетах',
                'description' => $descr,
                'category_id' => $inter
            ],
            [
                'name' => 'Золотая монета в 20$ (Вопрос конференции)',
                'description' => $descr,
                'category_id' => $inter
            ]
        ];

        foreach ($library_posts as $post){
            $lib = Library::create($post);
            File::create([
                'morphable_type' => 'App\Models\Library',
                'morphable_id' => $lib->id,
                'src' => '/assets/img/'.$imgs[rand(0,2)],
                'category' => 'img'
            ]);

            File::create([
                'morphable_type' => 'App\Models\Library',
                'morphable_id' => $lib->id,
                'src' => '/file.txt',
                'category' => 'file'
            ]);
        }

    }
}
