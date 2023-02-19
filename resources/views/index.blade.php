<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@include('includes.header')
<div class="page-content">
    <section class="slider">
        <div class="container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide slider-item">
                        <div class="slider-content">
                            <h3 class="slider-title">Интернет аукцион<br>в реальном времени</h3>
                            <p class="slider-text">Приобретайте редкие манеты и продовайте свою коллекцию</p>
                            <a href="{{route('register')}}" class="slider-btn">ПРОЙТИ РЕГИСТРАЦИЮ</a>
                        </div>
                        <img src="/assets/img/slider-img.png" alt="">
                    </div>

                    <div class="swiper-slide slider-item">
                        <div class="slider-content">
                            <h3 class="slider-title">Интернет аукцион<br>в реальном времени</h3>
                            <p class="slider-text">Приобретайте редкие манеты и продовайте свою коллекцию</p>
                            <a href="{{route('register')}}" class="slider-btn">ПРОЙТИ РЕГИСТРАЦИЮ</a>
                        </div>
                        <img src="/assets/img/slider-img.png" alt="">
                    </div>

                </div>

                <div class="swiper-button-next main-slider-arrow-right"></div>
                <div class="swiper-button-prev main-slider-arrow-left"></div>
                <div class="swiper-pagination slider-pagination"></div>
            </div>
        </div>
    </section>

    <section class="why">
        <div class="container">
            <div class="why-wrapper">
                <div class="why-left">
                    <div class="why-left-header">
                        <h3 class="why-title">Зачем регистрироваться ?</h3>
                        <span class="why-left-text">
                            После регистрации вам будет доступен, магазин, форум
                        </span>
                    </div>
                    <div class="why-blocks">
                        <div class="why-block">
                            <div class="why-img">
                                <img src="/assets/img/why-coin.png" alt="" class="">
                            </div>
                            <div class="why-block-right">
                                <h4>Магазин</h4>
                                <p>Уникальные редкие монеты со всего мира
                                    с доставкой прямо в руки</p>
                            </div>
                        </div>

                        <div class="why-block">
                            <div class="why-img">
                                <img src="/assets/img/why-coin.png" alt="" class="">
                            </div>
                            <div class="why-block-right">
                                <h4>Магазин</h4>
                                <p>Уникальные редкие монеты со всего мира
                                    с доставкой прямо в руки</p>
                            </div>
                        </div>

                        <div class="why-block">
                            <div class="why-img">
                                <img src="/assets/img/why-coin.png" alt="" class="">
                            </div>
                            <div class="why-block-right">
                                <h4>Магазин</h4>
                                <p>Уникальные редкие монеты со всего мира
                                    с доставкой прямо в руки</p>
                            </div>
                        </div>

                        <div class="why-block">
                            <div class="why-img">
                                <img src="/assets/img/why-coin.png" alt="" class="">
                            </div>
                            <div class="why-block-right">
                                <h4>Магазин</h4>
                                <p>Уникальные редкие монеты со всего мира
                                    с доставкой прямо в руки</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="why-right">
                    <img src="/assets/img/why-photo.png" alt="">
                    <a href="{{route('register')}}" class="why-btn">ПРОЙТИ РЕГИСТРАЦИЮ</a>
                </div>
            </div>
        </div>
    </section>

    @foreach($items as $key => $group)
        @if($key == 'App\Models\Product')
            <section class="lasted">
                <div class="container">
            <div class="posts-header">
                <div class="posts-header-title">
                    <h3>Последние поступления</h3>
                    <span>Смотрите, что недавно появилось в нашем магазине</span>
                </div>
                <a href="{{route('shop.index')}}" class="posts-header-btn">
                    Посмотреть все монеты
                    <img src="/assets/img/arrow-left.png" alt="">
                </a>
            </div>

            <div class="index-posts-wrap">

                <div class="swiper posts-slider">
                    <div class="swiper-wrapper">
                        @foreach($group as $item)
                        <div class="swiper-slide post-slide">
                            <div class="post-slide-img">
                                <img src="{{$item->img()}}" alt="">
                            </div>
                            <a href="#productModal" onclick="productModal('product','{{$item->id}}')" class="post-slide-fast-view" rel="modal:open">Быстрый просмотр</a>
                            <h3 class="post-slide-title">{{$item->title}}</h3>
                            <p class="post-slide-text">{{mb_substr($item->description, 0, 50).'...'}}</p>
                            <a href="{{route('shop.detail', $item->id)}}" class="post-slide-btn">Подробнее</a>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next slider-arrow-right"></div>
                    <div class="swiper-button-prev slider-arrow-left"></div>
                </div>

            </div>
        </div>
            </section>
        @endif
        @if($key == 'App\Models\Expertise')
            <section class="expertise">
                <div class="container">
            <div class="posts-header">
                <div class="posts-header-title">
                    <h3>Экспертиза монет</h3>
                    <span>Монеты на экспертизу</span>
                </div>
                <a href="{{route('expertise.index')}}" class="posts-header-btn">
                    Посмотреть все монеты
                    <img src="/assets/img/arrow-left.png" alt="">
                </a>
            </div>

            <div class="index-posts-wrap">

                <div class="swiper posts-slider">
                    <div class="swiper-wrapper">
                        @foreach($group as $item)
                        <div class="swiper-slide post-slide">
                            <div class="post-slide-img">
                                <img src="{{$item->img()}}" alt="">
                            </div>
                            <a href="#productModal" onclick="productModal('expertise','{{$item->id}}')" rel="modal:open" class="post-slide-fast-view">Быстрый просмотр</a>
                            <h3 class="post-slide-title">{{$item->title}}</h3>
                            <p class="post-slide-text">{{mb_substr($item->description, 0 , 30).'...'}}</p>
                            <a href="{{route('expertise.detail', $item->id)}}" class="post-slide-btn">Подробнее</a>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next slider-arrow-right"></div>
                    <div class="swiper-button-prev slider-arrow-left"></div>
                </div>

            </div>
        </div>
            </section>
        @endif
        @if($key == 'App\Models\News')
            <section class="last-news">
                <div class="container">
            <div class="posts-header">
                <div class="posts-header-title">
                    <h3>Последние новости</h3>
                    <span>Наши последние новости</span>
                </div>
                <a href="{{route('news.index')}}" class="posts-header-btn">
                    Посмотреть все новости
                    <img src="/assets/img/arrow-left.png" alt="">
                </a>
            </div>

            <div class="index-posts-wrap">
                <div class="swiper news-slider">
                    <div class="swiper-wrapper">
                        @foreach($group as $item)
                        <div class="swiper-slide news-slide-wrap">
                            <img src="{{$item->img()}}" class="news-slide-img" alt="">
                            <div class="news-slide-left-part">
                                <h3>{{$item->title}}</h3>
                                <a href="{{route('news.show', $item->id)}}" class="news-slide-btn">Подробнее
                                    <img src="/assets/img/arrow-left.png" alt="">
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next slider-arrow-right"></div>
                    <div class="swiper-button-prev slider-arrow-left"></div>
                </div>
            </div>
        </div>
            </section>
        @endif
    @endforeach

    <section class="info">
        <div class="container">
            <div class="posts-header-title">
                <h3>Информация</h3>
            </div>

            <div class="index-posts-wrap"></div>
        </div>
    </section>

    <section class="pre-footer">
        <div class="container">
            <div class="pre-footer-row">
                <div class="pre-footer-col">
                    <form action="#">
                        <input type="text" class="pre-footer-input" placeholder="Ваш Email">
                        <button type="submit" class="pre-footer-btn">ПОДПИСАТЬСЯ</button>
                    </form>
                </div>
                <div class="pre-footer-col">
                    <ul class="pre-footer-socials">
                        <li><a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="https://www.facebook.com/"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="https://www.facebook.com/"><i class="fa fa-google-plus"></i></a></li>
                        <li><a target="_blank" href="https://www.facebook.com/"><i class="fa fa-instagram"></i></a></li>
                        <li><a target="_blank" href="https://www.facebook.com/"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('includes.footer')
</div>

@include('includes.mobile')
<!-- Product modal -->
<div id="productModal" class="modal">

    <!-- Gallery -->
    <div class="productModalWrap">
        <div class="productGallery">
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                <div class="swiper-wrapper" id="product_slide_main">

                </div>
            </div>
            <div thumbsSlider="" class="swiper gallerySwiper">
                <div class="swiper-wrapper" id="product_slide_wrap">
                </div>
            </div>
        </div>
        <div class="productData">

        </div>
    </div>
    <!-- End Gallery -->
</div>

<!-- ---- -->
<script src="/assets/js/main.js"></script>
<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    function productModal(type, id){
        $.ajax({
            url: "/get-data/"+type+"/"+id,
            type: "POST",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                //Очищаем html
                $('.productData').html('');
                $('#product_slide_wrap').html('');
                $('#product_slide_main').html('');

                //Добавляем данные
                $('.productData').append(
                    '<h3>'+response.data.title+'</h3>' +
                    '<p>'+response.data.description+'</p>'
                )

                //проверка, есть-ли характеристики
                if(response.data.characteristics.length > 0) {
                    $('.productData').append(
                        '<h3 style="margin-top: 31px">Характеристики</h3>' +
                        '<div class="chars">'+
                        '</div>'
                    )

                    response.data.characteristics.forEach(function (item, i, arr) {
                        $('.chars').append('' +
                            '<div class="charWrap">' +
                            '<div class="charItem">' +
                            '<div class="charKey">' + item.name + ':</div>' +
                            '<div class="charVal">' + item.value + '</div>' +
                            '</div></div>');
                    })
                }

                //изображения
                response.data.images.forEach(function (item, i, arr){
                    $('#product_slide_wrap').append(
                        '<div class="swiper-slide">'+
                            '<img src="'+item+'" />'+
                        '</div>'
                    );

                    $('#product_slide_main').append(
                        '<div class="swiper-slide">'+
                            '<img src="'+item+'" />'+
                        '</div>'
                    );
                });

                // Вызываем еще раз свайпер
                var swiper = new Swiper(".gallerySwiper", {
                    loop: false,
                    spaceBetween: 10,
                    slidesPerView: 3,
                    freeMode: true,
                    watchSlidesProgress: true,
                    width: 335,
                    centeredSlides: true,
                });
                var swiper2 = new Swiper(".mySwiper2", {
                    loop: false,
                    spaceBetween: 10,
                    autoHeight: true,
                    thumbs: {
                        swiper: swiper,
                    },
                });
                //End
                ;
            },
            error: function(data) {
                //console.log(data);
            }
        });
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
            1300:{
                slidesPerView:2,
            },
            1250:{
                slidesPerView: 2,
            },
            350:{
                slidesPerView: 1,
            }
        }
    });
</script>
<script>
    var swiper = new Swiper(".gallerySwiper", {
        loop: false,
        spaceBetween: 10,
        slidesPerView: 3,
        freeMode: true,
        watchSlidesProgress: true,
        width: 335,
        centeredSlides: true,

        //   breakpoints: {
        //         750:{
        //             slidesPerView: 2,
        //         },
        //         650:{
        //             slidesPerView: 'auto',
        //             centeredSlides: false,
        //             watchSlidesProgress: false,
        //             width: null,
        //         }
        //     }
    });
    var swiper2 = new Swiper(".mySwiper2", {
        loop: false,
        spaceBetween: 10,
        autoHeight: true,
        //   navigation: {
        //     nextEl: ".swiper-button-next",
        //     prevEl: ".swiper-button-prev",
        //   },
        thumbs: {
            swiper: swiper,
        },
    });
</script>
</body>
</html>
