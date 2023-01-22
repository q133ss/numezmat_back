//delete

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$category->name}} | Экспертиза</title>
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
                        <li><a href="{{route('rating.index')}}">Экспертиза</a></li>
                        @foreach($category->getParents() as $category)
                            <li><a href="{{route('rating.show', $category)}}">{{$category->name}}</a></li>
                        @endforeach
                        <li>{{$category->name}}</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/expertImg.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Экспертиза монет
                        </h3>
                        <span class="page-sub-title">
                                Монеты на экспертизу
                            </span>
                    </div>
                </div>
                <div class="page-header-right">
                    <select name="sort" id="" class="page-header-sort">
                        <option value="#">По активности</option>
                        <option value="#">По дате</option>
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
                    @if($categories->isEmpty())
                        <div class="post">
                            <span class="post-title" style="width: 100%;text-align: center;align-self: center;">Записи отсутствуют</span>
                        </div>
                    @endif
                </div>
                <div class="ads">
                    @include('includes.ad', ['count' => 2])
                </div>
            </div>

            {{$categories->links('includes.pagination')}}
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
