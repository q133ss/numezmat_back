<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>

</head>
<body>
<div class="before-header">
    <div class="before-header-container">
        <div class="before-header-left">
            <ul>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </div>
        <div class="before-header-right">
            <ul>
                <li>Телефон: <em>+7(495)123-45-67</em></li>
                <li><a href="#">Вход</a></li>
                <li><a href="#">Регистрация</a></li>
            </ul>
        </div>
    </div>
</div>

@include('includes.header')

<div class="page-content">

    <section class="page-header">
        <div class="container">
            <div class="page-header-wrap">
                <div class="page-header-left">
                    <ul class="breadcrumbs">
                        <li><a href="/">Главная</a></li>
                        <li>Новости</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/newImg.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Последние новости
                        </h3>
                        <span class="page-sub-title">
                                Наши последние новости
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
            <div class="news-wrapper">
                <div class="news-slide-wrap">
                    <img src="/assets/img/news1.png" class="news-slide-img" alt="">
                    <div class="news-slide-left-part">
                        <h3>50 ЛЕТ МЕЖДУНАРОДНОЙ
                            ОРГАНИЗАЦИИ ФРАНКОФОНИИ
                            НА 50 БАНИ И 10 ЛЕЯХ РУМЫНИИ</h3>
                        <a href="#" class="news-slide-btn">Подробнее
                            <img src="/assets/img/arrow-left.png" alt="">
                        </a>
                    </div>
                </div>

                <div class="news-slide-wrap">
                    <img src="/assets/img/news1.png" class="news-slide-img" alt="">
                    <div class="news-slide-left-part">
                        <h3>50 ЛЕТ МЕЖДУНАРОДНОЙ
                            ОРГАНИЗАЦИИ ФРАНКОФОНИИ
                            НА 50 БАНИ И 10 ЛЕЯХ РУМЫНИИ</h3>
                        <a href="#" class="news-slide-btn">Подробнее
                            <img src="/assets/img/arrow-left.png" alt="">
                        </a>
                    </div>
                </div>

                <div class="news-slide-wrap">
                    <img src="/assets/img/news1.png" class="news-slide-img" alt="">
                    <div class="news-slide-left-part">
                        <h3>50 ЛЕТ МЕЖДУНАРОДНОЙ
                            ОРГАНИЗАЦИИ ФРАНКОФОНИИ
                            НА 50 БАНИ И 10 ЛЕЯХ РУМЫНИИ</h3>
                        <a href="#" class="news-slide-btn">Подробнее
                            <img src="/assets/img/arrow-left.png" alt="">
                        </a>
                    </div>
                </div>

                <div class="news-slide-wrap">
                    <img src="/assets/img/news1.png" class="news-slide-img" alt="">
                    <div class="news-slide-left-part">
                        <h3>50 ЛЕТ МЕЖДУНАРОДНОЙ
                            ОРГАНИЗАЦИИ ФРАНКОФОНИИ
                            НА 50 БАНИ И 10 ЛЕЯХ РУМЫНИИ</h3>
                        <a href="#" class="news-slide-btn">Подробнее
                            <img src="/assets/img/arrow-left.png" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="posts-paginate">
                <ul>
                    <li class="current-page">1</li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">7</a></li>
                </ul>
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
