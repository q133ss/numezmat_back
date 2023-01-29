<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
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
                        <li>Каталог</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/catalogImg.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Каталог
                        </h3>
                        <span class="page-sub-title">
                                Каталог монет
                            </span>
                    </div>
                </div>
                <div class="page-header-right">

                    <div class="catalog-search">
                        <img src="/assets/img/Search_fill.png" class="catalog-search-icon" alt="">
                        <input type="text" placeholder="Искать в документах" class="catalog-search-input">
                    </div>

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
                        <div class="post-content catalog-post-content">
                            <div class="post-description">
                                <h3 class="post-title">
                                    Монеты на оценку
                                </h3>

                                <div class="post-categories">
                                    @foreach(\App\Models\Category::getSubCategories('App\Models\Catalog', $category->id, 4)->get() as $subCat)
                                    <a href="{{route('catalog.show', $subCat->id)}}" class="post-category">
                                        <img src="/assets/img/Folder_fill.png" class="post-category-icon" alt="">
                                        {{$subCat->name}}
                                    </a>
                                    @endforeach
                                </div>

                                <a href="" class="post-btn">Подробнее
                                    <img src="/assets/img/arrow-left.png" alt="">
                                </a>
                            </div>
                            <div class="post-info post-catalog-info">
                                    <span class="post-info-item">
                                        Разделы:  <span class="post-info-item-count">{{\App\Models\Category::getSubCategories('App\Models\Catalog', $category->id, 1000)->count()}}</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
