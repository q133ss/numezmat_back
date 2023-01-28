<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$category->name}} | Оценка монет</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
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
                        <li><a href="{{route('rating.index')}}">Определение и оценка</a></li>
                        @foreach($category->getParents() as $category)
                            <li><a href="{{route('rating.show', $category)}}">{{$category->name}}</a></li>
                        @endforeach
                        <li>{{$category->name}}</li>
                    </ul>
                    <div class="page-title-block">
                        <h3 class="page-title">
                            Оценка монет
                        </h3>
                        <span class="page-sub-title">
                                {{$category->name}}
                        </span>
                    </div>
                </div>
                <div class="page-header-right">

{{--                    <div class="catalog-search">--}}
{{--                        <img src="/assets/img/Search_fill.png" class="catalog-search-icon" alt="">--}}
{{--                        <input type="text" placeholder="Искать в документах" class="catalog-search-input">--}}
{{--                    </div>--}}

                    <select name="sort" onchange="sort($(this).val())" class="page-header-sort">
                        <option value="" disabled selected>Сортировка</option>
                        <option value="active">По активности</option>
                        <option value="date">По дате</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <section class="content-wrap">
        <div class="container">
            <div class="posts-page-wrap">
                <div class="posts-wrapper">
                    @foreach($categories as $category)
                        <div class="post">
                            <img src="{{$category->img()}}" class="post-image" alt="">
                            <div class="post-content">
                                <div class="post-description">
                                    <h3 class="post-title">
                                        {{$category->name}}
                                    </h3>
                                    <p class="post-except">
                                        {{$category->description}}
                                    </p>

                                    <a href="{{route('rating.show', $category->id)}}" class="post-btn">Подробнее
                                        <img src="/assets/img/arrow-left.png" alt="">
                                    </a>
                                </div>

                                <div class="post-info">
                                    <span class="post-info-item">
                                        Экспертизы:  <span class="post-info-item-count">{{$category->getItems('ratings', $category->id)->count()}}</span>
                                    </span>
                                    <span class="post-info-item">
                                        Просмотры:  <span class="post-info-item-count">{{$category->views_count ?? '0'}}</span>
                                    </span>
                                    <span class="post-date">
                                        Создано - {{$category->date()}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach

{{--                    Items!--}}
                        @foreach($items as $item)
                        <div class="search-result">
                                <div class="post">
                                    <img src="{{$item->img()}}" class="post-image" alt="">
                                    <div class="post-content">
                                        <div class="post-description">
                                            <h3 class="post-title">
                                                {{$item->title}}
                                            </h3>
                                            <p class="post-except">
                                                {{ strip_tags(mb_substr($item->description, 0, 100)) }}
                                                @if(strlen($item->description) > 100)
                                                    ...
                                                @endif
                                            </p>

                                            <a href="{{route('rating.detail', $item->id)}}" class="post-btn">Подробнее
                                                <img src="/assets/img/arrow-left.png" alt="">
                                            </a>
                                        </div>
                                        <div class="post-info search-post-info">
                                        <span class="post-info-item">
                                            <!-- Оценки:  <span class="post-info-item-count">64</span> -->
                                        </span>
                                            <span class="post-info-item">
                                            <!-- Просмотры:  <span class="post-info-item-count">64</span> -->
                                        </span>
                                            <span class="post-date">
                                                @if(!$item->characteristics->where('key', 'year')->isEmpty())
                                            Год - <span class="search-val">{{$item->characteristics->where('key', 'year')->pluck('value')->first()}}</span>
                                                @endif
                                                @if(!$item->characteristics->where('key', 'condition')->isEmpty())
                                            Состояние - <span class="search-val">{{$item->characteristics->where('key', 'condition')->pluck('value')->first()}}</span>
                                                @endif
                                        </span>
                                        </div>
                                    </div>
                                </div>
                    </div>
                        @endforeach
                        @if($items->isEmpty() && $categories->isEmpty())
                            <div class="post" style="text-align: center"><span class="post-title" style="align-self: center;width: 100%;">Ничего не найдено</span></div>
                        @endif
{{--                    end items--}}
                </div>
                <div class="ads">
                    @if(!$category->getFiltersForRating()->isEmpty())
                    <div class="filter">
                        <h3 class="characteristics-title">Фильтр</h3>

                        <form action="" class="form-filter">
                            @foreach($category->getFiltersForRating() as $filter)
                            <div class="filter-group">
                                <label for="year" class="characteristics-key">
                                    {{$filter->name}}
                                </label>
                                <select name="{{$filter->db_key}}" id="year" class="filter-select">
                                    <option value="#" selected disabled>Выбрать</option>
                                    @foreach(array_unique($category->getFilterValuesForRating($filter->db_key)) as $value)
                                    <option value="{{$value}}" @if(array_key_exists($filter->db_key, \Request()->query()) && \Request()->query()[$filter->db_key] == $value) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endforeach
                            <input type="hidden" id="sort-field" value="date" name="sort">
                            <button class="filter-btn">Фильтровать</button>
                        </form>
                    </div>
                    @endif
                    @include('includes.ad', ['count' => 1])
                </div>
            </div>

            {{$items->links('includes.pagination')}}
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

    function sort(val){
        $('#sort-field').val(val)
    }

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
