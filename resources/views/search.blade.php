<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>

</head>
<body>
@include('includes.header')

<div class="page-content">

    <section class="page-header">
        <div class="container">
            <div class="page-header-wrap">
                <div class="page-header-left">
                    <ul class="breadcrumbs">
                        <li><a href="/">Главная</a></li>
                        <li>Поиск</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/Search_alt_fill.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Поиск
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-wrap search-content">
        <div class="container">
            <div class="search-wrap">
                <form action="">
                <div class="search-request-wrap">
                    <h3 class="search-header">Запрос:</h3>
                    <input type="text" name="search" value="{{\Request()->search}}" placeholder="Монета 1" class="search-request">
                    <img src="/assets/img/search-inp.png" class="search-inp-ico" alt="">
                </div>
                <div class="search-filters">
                    <div>
                        <label class="search-header">Искать в</label>
                        <select name="category" class="search-filter" id="">
                            <option value="all" @if(\Request()->category == 'all') selected @endif>Везде</option>
                            <option value="news" @if(\Request()->category == 'news') selected @endif>Новости</option>
                            <option value="rating" @if(\Request()->category == 'rating') selected @endif>Оценка</option>
                            <option value="expertise" @if(\Request()->category == 'expertise') selected @endif>Экспертиза</option>
                            <option value="catalog" @if(\Request()->category == 'catalog') selected @endif>Каталог</option>
                            <option value="product" @if(\Request()->category == 'product') selected @endif>Магазин</option>
                            <option value="library" @if(\Request()->category == 'library') selected @endif>Библиотека</option>
                            <option value="forum" @if(\Request()->category == 'forum') selected @endif>Беседка</option>
                        </select>
                    </div>
                    <button type="submit" class="comment-form-btn">Фильтровать</button>
                </div>
                </form>
            </div>

            <div class="search-result-wrap">
                @if(!$items->isEmpty())
                @foreach($items->first() as $group)
                @foreach($group as $item)
                <div class="search-results">
                    <div class="search-result">
                        <div class="news-slide-wrap">
                            <img src="{{$item->img()}}" style="width: 269px" class="news-slide-img" alt="">
                            <div class="news-slide-left-part">
                                <h3>
                                @if(isset($item->title))
                                    {{$item->title}}
                                @else
                                    {{$item->name ?? '11'}}
                                @endif
                                </h3>
                                @if($item->getTable() == 'news')
                                    <a href="{{route('news.show', $item->id)}}" class="news-slide-btn">Подробнее
                                        <img src="/assets/img/arrow-left.png" alt="">
                                    </a>
                                @elseif($item->getTable() == 'ratings')
                                    <a href="{{route('rating.detail', $item->id)}}" class="news-slide-btn">Подробнее
                                        <img src="/assets/img/arrow-left.png" alt="">
                                    </a>
                                @elseif($item->getTable() == 'expertises')
                                    <a href="{{route('expertise.detail', $item->id)}}" class="news-slide-btn">Подробнее
                                        <img src="/assets/img/arrow-left.png" alt="">
                                    </a>
                                @elseif($item->getTable() == 'catalogs')
                                    <a href="{{route('catalog.detail', $item->id)}}" class="news-slide-btn">Подробнее
                                        <img src="/assets/img/arrow-left.png" alt="">
                                    </a>
                                @elseif($item->getTable() == 'products')
                                    <a href="{{route('shop.detail', $item->id)}}" class="news-slide-btn">Подробнее
                                        <img src="/assets/img/arrow-left.png" alt="">
                                    </a>
                                @elseif($item->getTable() == 'libraries')
                                    <a href="{{route('library.detail', $item->id)}}" class="news-slide-btn">Подробнее
                                        <img src="/assets/img/arrow-left.png" alt="">
                                    </a>
                                @elseif($item->getTable() == 'forums')
                                    <a href="{{route('forum.detail', $item->id)}}" class="news-slide-btn">Подробнее
                                        <img src="/assets/img/arrow-left.png" alt="">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
                @endif

{{--                <div class="search-results">--}}
{{--                    <div class="search-result">--}}
{{--                        <div class="post">--}}
{{--                            <img src="/assets/img/news1.png" class="post-image" alt="">--}}
{{--                            <div class="post-content">--}}
{{--                                <div class="post-description">--}}
{{--                                    <h3 class="post-title">--}}
{{--                                        Монеты на оценку--}}
{{--                                    </h3>--}}
{{--                                    <p class="post-except">--}}
{{--                                        Уникальные редкие монеты со всего мира с доставкой прямо в руки--}}
{{--                                    </p>--}}

{{--                                    <a href="" class="post-btn">Подробнее--}}
{{--                                        <img src="/assets/img/arrow-left.png" alt="">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="post-info search-post-info">--}}
{{--                                        <span class="post-info-item">--}}
{{--                                            <!-- Оценки:  <span class="post-info-item-count">64</span> -->--}}
{{--                                        </span>--}}
{{--                                    <span class="post-info-item">--}}
{{--                                            <!-- Просмотры:  <span class="post-info-item-count">64</span> -->--}}
{{--                                        </span>--}}
{{--                                    <span class="post-date">--}}
{{--                                            Год - <span class="search-val">2012</span>--}}

{{--                                            Состояние - <span class="search-val">Новое</span>--}}
{{--                                        </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>

    @include('includes.footer')
</div>

@include('includes.mobile')
<script src="/assets/js/main.js"></script>
<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            renderBullet: function (index, className) {
                return '<button class="slider-paginate '+className+'"></button>';
            }
        }
    });

    var swiper = new Swiper(".posts-slider", {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            900:{
                slidesPerView: 1,
            },
            650:{
                slidesPerView: 1,
            },
            350:{
                slidesPerView: 1,
            }
        }
    });

    var swiper = new Swiper(".news-slider", {
        slidesPerView: 2,
        spaceBetween: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            1250:{
                slidesPerView: 1,
            },
            350:{
                slidesPerView: 1,
            }
        }
    });
</script>
</body>
</html>
