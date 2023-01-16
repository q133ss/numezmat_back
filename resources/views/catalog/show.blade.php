<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>10 Копеек 2012</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/752l8byduhddjuj8adfjo4ntwolgqwjrr1bhlxn26marh09g/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <style>
        .detail_slider {
            padding: 10px 16px;
            color: #fff;
            box-sizing: border-box;
            width: 100%;
            overflow: hidden;
            background-color: #F3F7FA;
        }

        .detail_slider .swiper-container {
            width: 100%;
            height: 100%;
        }

        .slider__flex {
            display: flex;
            align-items: flex-start;
        }

        .slider__col {
            display: flex;
            flex-direction: column;
            width: 150px;
            margin-left: 13px;
        }

        .slider__prev,
        .slider__next {
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .slider__prev:focus,
        .slider__next:focus {
            outline: none;
        }

        .slider__thumbs {
            height: calc(400px - 96px);
        }

        .slider__thumbs .slider__image {
            transition: 0.25s;
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
            opacity: 0.5;
        }

        .slider__thumbs .slider__image:hover {
            opacity: 1;
        }

        .slider__thumbs .swiper-slide-thumb-active .slider__image {
            -webkit-filter: grayscale(0%);
            filter: grayscale(0%);
            opacity: 1;
        }

        .slider__images {
            height: 327px;
        }

        .slider__images .slider__image img {
            transition: 3s;
        }

        .slider__images .slider__image:hover img {
            transform: scale(1.1);
        }

        .slider__image {
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 4px;
        }

        .slider__image img {
            display: block;
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        @media (max-width: 767.98px) {
            .slider__flex {
                flex-direction: column-reverse;
            }

            .slider__col {
                flex-direction: row;
                align-items: center;
                margin-right: 0;
                margin-top: 24px;
                width: 100%;
            }

            .slider__images {
                width: 100%;
            }

            .slider__thumbs {
                height: 100px;
                width: calc(100% - 96px);
                margin: 0 16px;
            }

            .slider__prev,
            .slider__next {
                height: auto;
                width: 32px;
            }
        }
    </style>
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
                        <li><a href="/">Оценка монет</a></li>
                        <li><a href="/">Монеты на оценку</a></li>
                        <li>Оцените мою монету</li>
                    </ul>
                    <div class="page-title-block">
                        <h3 class="page-title">
                            25 Копеек 2012
                        </h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="rating-show">
        <div class="container">
            <div class="rating-show-content">
                <div class="rating-show-info">
                    <!-- SWIPER GALLERY -->
                    <section class="detail_slider">
                        <div class="container">
                            <div class="slider__flex">
                                <div class="slider__images">
                                    <div class="swiper-container"> <!-- Слайдер с изображениями -->
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="slider__image">
                                                    <img src="https://picsum.photos/1920/1080" alt="" />
                                                    <div class="rating_view_btn"><a rel="modal:open"
                                                                                    href="#photoModal">Быстрый просмотр</a></div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="slider__image"><img
                                                        src="https://picsum.photos/1920/1081" alt="" />
                                                    <div class="rating_view_btn"><a rel="modal:open"
                                                                                    href="#photoModal">Быстрый просмотр</a></div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="slider__image"><img
                                                        src="https://picsum.photos/1920/1082" alt="" />
                                                    <div class="rating_view_btn"><a rel="modal:open"
                                                                                    href="#photoModal">Быстрый просмотр</a></div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="slider__image"><img
                                                        src="https://picsum.photos/1920/1083" alt="" />
                                                    <div class="rating_view_btn"><a rel="modal:open"
                                                                                    href="#photoModal">Быстрый просмотр</a></div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="slider__image"><img
                                                        src="https://picsum.photos/1920/1084" alt="" />
                                                    <div class="rating_view_btn"><a rel="modal:open"
                                                                                    href="#photoModal">Быстрый просмотр</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider__col">

                                    <div class="slider__thumbs">
                                        <div class="swiper-container"> <!-- Слайдер с превью -->
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="slider__image"><img
                                                            src="https://picsum.photos/1920/1080" alt="" />
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="slider__image"><img
                                                            src="https://picsum.photos/1920/1081" alt="" />
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="slider__image"><img
                                                            src="https://picsum.photos/1920/1082" alt="" />
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="slider__image"><img
                                                            src="https://picsum.photos/1920/1083" alt="" />
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="slider__image"><img
                                                            src="https://picsum.photos/1920/1084" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>
                    <!-- END SWIPER GALLERY -->
                    <div class="rating-show-info-block">
                        <div class="catalog-data">
                            <h3>Характеристики</h3>
                            <div class="catalog-char-wrap">
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">Страна:</div>
                                    <div class="cat-char-val">Россия</div>
                                </div>
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">Тираж (шт):</div>
                                    <div class="cat-char-val">5 000 000</div>
                                </div>
                            </div>

                            <div class="catalog-char-wrap">
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">Тип:</div>
                                    <div class="cat-char-val">Юбилейная или памятная</div>
                                </div>
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">Материал:</div>
                                    <div class="cat-char-val">Мельхиор</div>
                                </div>
                            </div>

                            <div class="catalog-char-wrap">
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">Год:</div>
                                    <div class="cat-char-val">2020 г.</div>
                                </div>
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">Толщина (мм):</div>
                                    <div class="cat-char-val">2,3 мм</div>
                                </div>
                            </div>

                            <div class="catalog-char-wrap">
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">Номинал:</div>
                                    <div class="cat-char-val">25 рублей.</div>
                                </div>
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">Вес монеты (г):</div>
                                    <div class="cat-char-val">10</div>
                                </div>
                            </div>

                            <div class="catalog-char-wrap">
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">Диаметр (мм):</div>
                                    <div class="cat-char-val">27</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rating-show-control">
                    <a href="#" class="rating-show-edit-btn">Редактировать тему <img src="/assets/img/Edit_fill.png"
                                                                                     alt=""></a>
                    <a href="#" class="rating-show-block-btn">Заблокировать тему</a>
                </div>

            </div>
            <div class="rating-show-wrapper">
                <div class="rating-show-content">


                    <h4 class="rating-show-other-themes">Добавить комментарий</h4>
                    <button class="comment-form-btn comment-btn">Прокоментировать</button>
                    <div class="comment-area display-n">
                        <div class="comment-avatar-block">
                            <img src="/assets/img/Ellipse66.png" class="comment-avatar" alt="">
                            <div class="comment-nick">
                                @unkind
                            </div>
                        </div>
                        <form action="#" class="comment-form">
                            <select name="" id="" class="comment-select-coin">
                                <option value="" selected disabled>Прикрепить монету</option>
                            </select>
                            <textarea name="" id="" class="comment-field" cols="100" rows="10"
                                      placeholder="Ваш коментарий"></textarea>
                            <div class="comment-form-btn-wrap">
                                <button class="comment-form-btn">Опубликовать</button>
                            </div>
                        </form>
                    </div>

                    <div class="comments">
                        <div class="comment-block">
                            <div class="comment">
                                <div class="comment-author">
                                    <img src="/assets/img/ava.png" alt="" class="comment-author-avatar">
                                    <div class="comment-author-info">
                                            <span class="comment-author-nick">
                                                @unkind
                                            </span>
                                        <span class="comment-author-date">
                                                12 November 2020 19:35
                                            </span>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    Старинных царских монет существует такое большое количество, что совсем не
                                    просто определиться со сбором конкретной коллекции или разобраться с ценой
                                    монеты ...
                                </div>
                                <div class="comment-coin">
                                    <span class="comment-coin-count">1</span>
                                    Оцените мою монету
                                </div>
                                <div class="comment-footer">
                                    <div class="comment-likes">
                                        <div class="comment-like">
                                            <img src="/assets/img/thumbs-up.png" alt="">
                                            12
                                        </div>
                                        <div class="comment-dislike">
                                            <img src="/assets/img/thumbs-down.png" alt="">
                                            3
                                        </div>
                                    </div>
                                    <div class="comment-footer-right">
                                        <button class="comment-answers">
                                            Показать ответы
                                            <span class="comment-answer-count">
                                                    (4)
                                                </span>
                                        </button>
                                        <button class="comment-answer">
                                            <img src="/assets/img/corner-down-right.png" alt="">
                                            Ответить
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="sub-comment">
                                <div class="sub-comment-text">
                                    <span class="sub-comment-reply">@unkind, </span>Старые монеты займут достойное
                                    место в вашей коллекции. Например, чистого серебра в одном рубле содержится 18
                                    грамм. В течение 19 века такая денежная ...
                                </div>
                                <div class="sub-comment-footer">
                                    <div class="sub-comment-author">
                                        by @lazyReplyer
                                    </div>
                                    <button class="comment-answer">
                                        <img src="/assets/img/corner-down-right.png" alt="">
                                        Ответить
                                    </button>
                                </div>
                            </div>

                            <div class="sub-comment">
                                <div class="sub-comment-text">
                                    <span class="sub-comment-reply">@unkind, </span>Старые монеты займут достойное
                                    место в вашей коллекции. Например, чистого серебра в одном рубле содержится 18
                                    грамм. В течение 19 века такая денежная ...
                                </div>
                                <div class="sub-comment-footer">
                                    <div class="sub-comment-author">
                                        by @lazyReplyer
                                    </div>
                                    <button class="comment-answer">
                                        <img src="/assets/img/corner-down-right.png" alt="">
                                        Ответить
                                    </button>
                                </div>
                            </div>

                            <div class="sub-comment">
                                <div class="sub-comment-text">
                                    <span class="sub-comment-reply">@unkind, </span>Старые монеты займут достойное
                                    место в вашей коллекции. Например, чистого серебра в одном рубле содержится 18
                                    грамм. В течение 19 века такая денежная ...
                                </div>
                                <div class="sub-comment-footer">
                                    <div class="sub-comment-author">
                                        by @lazyReplyer
                                    </div>
                                    <button class="comment-answer">
                                        <img src="/assets/img/corner-down-right.png" alt="">
                                        Ответить
                                    </button>
                                </div>
                            </div>

                            <div class="sub-comment">
                                <div class="sub-comment-text">
                                    <span class="sub-comment-reply">@unkind, </span>Старые монеты займут достойное
                                    место в вашей коллекции. Например, чистого серебра в одном рубле содержится 18
                                    грамм. В течение 19 века такая денежная ...
                                </div>
                                <div class="sub-comment-footer">
                                    <div class="sub-comment-author">
                                        by @lazyReplyer
                                    </div>
                                    <button class="comment-answer">
                                        <img src="/assets/img/corner-down-right.png" alt="">
                                        Ответить
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="comment-block">
                            <div class="comment">
                                <div class="comment-author">
                                    <img src="/assets/img/ava.png" alt="" class="comment-author-avatar">
                                    <div class="comment-author-info">
                                            <span class="comment-author-nick">
                                                @unkind
                                            </span>
                                        <span class="comment-author-date">
                                                12 November 2020 19:35
                                            </span>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    Старинных царских монет существует такое большое количество, что совсем не
                                    просто определиться со сбором конкретной коллекции или разобраться с ценой
                                    монеты ...
                                </div>
                                <div class="comment-coin">
                                    <span class="comment-coin-count">1</span>
                                    Оцените мою монету
                                </div>
                                <div class="comment-footer">
                                    <div class="comment-likes">
                                        <div class="comment-like">
                                            <img src="/assets/img/thumbs-up.png" alt="">
                                            12
                                        </div>
                                        <div class="comment-dislike">
                                            <img src="/assets/img/thumbs-down.png" alt="">
                                            3
                                        </div>
                                    </div>
                                    <div class="comment-footer-right">
                                        <button class="comment-answers">
                                            Показать ответы
                                            <span class="comment-answer-count">
                                                    (4)
                                                </span>
                                        </button>
                                        <button class="comment-answer">
                                            <img src="/assets/img/corner-down-right.png" alt="">
                                            Ответить
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="sub-comment">
                                <div class="sub-comment-text">
                                    <span class="sub-comment-reply">@unkind, </span>Старые монеты займут достойное
                                    место в вашей коллекции. Например, чистого серебра в одном рубле содержится 18
                                    грамм. В течение 19 века такая денежная ...
                                </div>
                                <div class="sub-comment-footer">
                                    <div class="sub-comment-author">
                                        by @lazyReplyer
                                    </div>
                                    <button class="comment-answer">
                                        <img src="/assets/img/corner-down-right.png" alt="">
                                        Ответить
                                    </button>
                                </div>
                            </div>

                            <div class="sub-comment">
                                <div class="sub-comment-text">
                                    <span class="sub-comment-reply">@unkind, </span>Старые монеты займут достойное
                                    место в вашей коллекции. Например, чистого серебра в одном рубле содержится 18
                                    грамм. В течение 19 века такая денежная ...
                                </div>
                                <div class="sub-comment-footer">
                                    <div class="sub-comment-author">
                                        by @lazyReplyer
                                    </div>
                                    <button class="comment-answer">
                                        <img src="/assets/img/corner-down-right.png" alt="">
                                        Ответить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rating-show-sidebar">
                    <div class="rating-show-sidebar-wrap">
                        <div class="sidebar-other-theme">
                            <img src="/assets/img/post1.png" class="other-theme-img" alt="">
                            <h3 class="other-theme-title">КАЛАБРИЯ, ТАРЕНТ ДИОБОЛ
                                280-228 ГГ. ДО Н.Э.</h3>
                            <p class="other-theme-text">
                                25 рублей 1899 года Тимашев Морозов
                            </p>
                            <a href="#" class="other-theme-btn">Подробнее</a>
                        </div>

                        <div class="sidebar-other-theme">
                            <img src="/assets/img/post1.png" class="other-theme-img" alt="">
                            <h3 class="other-theme-title">КАЛАБРИЯ, ТАРЕНТ ДИОБОЛ
                                280-228 ГГ. ДО Н.Э.</h3>
                            <p class="other-theme-text">
                                25 рублей 1899 года Тимашев Морозов
                            </p>
                            <a href="#" class="other-theme-btn">Подробнее</a>
                        </div>

                        <div class="sidebar-other-theme">
                            <img src="/assets/img/post1.png" class="other-theme-img" alt="">
                            <h3 class="other-theme-title">КАЛАБРИЯ, ТАРЕНТ ДИОБОЛ
                                280-228 ГГ. ДО Н.Э.</h3>
                            <p class="other-theme-text">
                                25 рублей 1899 года Тимашев Морозов
                            </p>
                            <a href="#" class="other-theme-btn">Подробнее</a>
                        </div>

                        <div class="sidebar-other-theme">
                            <img src="/assets/img/post1.png" class="other-theme-img" alt="">
                            <h3 class="other-theme-title">КАЛАБРИЯ, ТАРЕНТ ДИОБОЛ
                                280-228 ГГ. ДО Н.Э.</h3>
                            <p class="other-theme-text">
                                25 рублей 1899 года Тимашев Морозов
                            </p>
                            <a href="#" class="other-theme-btn">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('includes.footer')
</div>

@include('includes.mobile')
<div id="photoModal" class="modal">
    <img src="" id="photoModalImg" alt="">
</div>

<!-- ---- -->
<script src="/assets/js/main.js"></script>
<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script>
    $('.comment-btn').click(function(){
        $('.comment-area').toggleClass('display-n');
    });
    //Modal img
    $('.rating_view_btn').click(function () {
        let path = $(this).parent().parent().find('img').attr('src');
        $('#photoModalImg').attr('src', path);
    });

    //Swiper
    // Инициализация превью слайдера
    const sliderThumbs = new Swiper('.slider__thumbs .swiper-container', { // ищем слайдер превью по селектору
        // задаем параметры
        direction: 'vertical', // вертикальная прокрутка
        slidesPerView: 3, // показывать по 3 превью
        spaceBetween: 24, // расстояние между слайдами
        mousewheel: true,
        navigation: { // задаем кнопки навигации
            nextEl: '.slider__next', // кнопка Next
            prevEl: '.slider__prev' // кнопка Prev
        },
        freeMode: true, // при перетаскивании превью ведет себя как при скролле
        breakpoints: { // условия для разных размеров окна браузера
            0: { // при 0px и выше
                direction: 'horizontal', // горизонтальная прокрутка
            },
            768: { // при 768px и выше
                direction: 'vertical', // вертикальная прокрутка
            }
        }
    });
    // Инициализация слайдера изображений
    const sliderImages = new Swiper('.slider__images .swiper-container', { // ищем слайдер превью по селектору
        // задаем параметры
        direction: 'vertical', // вертикальная прокрутка
        slidesPerView: 1, // показывать по 1 изображению
        spaceBetween: 72, // расстояние между слайдами
        mousewheel: true, // можно прокручивать изображения колёсиком мыши

        grabCursor: true, // менять иконку курсора
        thumbs: { // указываем на превью слайдер
            swiper: sliderThumbs // указываем имя превью слайдера
        },
        breakpoints: { // условия для разных размеров окна браузера
            0: { // при 0px и выше
                direction: 'horizontal', // горизонтальная прокрутка
            },
            768: { // при 768px и выше
                direction: 'vertical', // вертикальная прокрутка
            }
        }
    });
</script>

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
                return '<button class="slider-paginate ' + className + '"></button>';
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
            900: {
                slidesPerView: 1,
            },
            650: {
                slidesPerView: 1,
            },
            350: {
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
            1250: {
                slidesPerView: 1,
            },
            350: {
                slidesPerView: 1,
            }
        }
    });
</script>

<script>
    tinymce.init({
        selector: '.comment-field',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        language: 'ru',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ]
    });
</script>
</body>

</html>
