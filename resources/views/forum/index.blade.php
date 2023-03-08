<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Беседка</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

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
                        <li>Беседка</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/discussion.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Беседка
                        </h3>
                        <span class="page-sub-title"></span>
                    </div>
                </div>
                <div class="page-header-right">

                    <form action="" method="GET" style="display: inline-block">
                        <select name="sort" id="sortSelect" class="page-header-sort">
                            <option value="" >Сортировка</option>
                            @php $sort = \Request()->query(); @endphp
                            <option value="active" @if(in_array('active', $sort)) selected @endif>По активности</option>
                            <option value="date" @if(in_array('date', $sort)) selected @endif>По дате</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="content-wrap">
        <div class="container">
            <div class="posts-page-wrap">
                <div class="posts-wrapper">
                    @can('create-sections-forum')
                        @php $args = ['parent_id' => 1]; @endphp
                        <a href="{{route('forum.create.section')}}" class="comment-form-btn" style="display: block; margin-bottom: 20px; margin-top: 0;">Добавить новый раздел</a>
                    @endcan
                    @foreach($categories as $category)
                    <div class="post">
                        <img src="{{$category->img()}}" style="cursor: pointer" onclick="location.href='{{route('forum.show', $category->id)}}'" class="post-image" alt="">
                        <div class="post-content catalog-post-content">
                            <div class="post-description">
                                <h3 class="post-title">
                                    {{$category->name}}
                                </h3>

                                <div class="post-categories">
                                    @foreach(\App\Models\Category::getSubCategories('App\Models\Forum', $category->id, 4)->get() as $subCat)
                                    <a href="{{route('forum.show', $subCat->id)}}" class="post-category">
                                        <img src="/assets/img/Folder_fill.png" class="post-category-icon" alt="">
                                        {{$subCat->name}}
                                    </a>
                                    @endforeach
                                </div>

                                <a href="{{route('forum.show', $category->id)}}" class="post-btn">Подробнее
                                    <img src="/assets/img/arrow-left.png" alt="">
                                </a>
                            </div>
                            <div class="post-info post-catalog-info">
                                    <span class="post-info-item">
                                        Разделы:  <span class="post-info-item-count">{{\App\Models\Category::getSubCategories('App\Models\Forum', $category->id, 1000)->count()}}</span>
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
