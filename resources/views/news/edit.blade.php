<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$post->title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/752l8byduhddjuj8adfjo4ntwolgqwjrr1bhlxn26marh09g/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</head>

<body>

<style>
    .news-edit-label:not(:first-child){
        display: block;
        margin-top: 25px;
    }
</style>

@include('includes.header')

<div class="page-content">

    <section class="page-header">
        <div class="sw_container">
            <div class="page-header-wrap">
                <div class="page-header-left">
                    <ul class="breadcrumbs">
                        <li><a href="/">Главная</a></li>
                        <li><a href="{{route('news.index')}}">Новости</a></li>
                        <li>{{$post->title}}</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/revMyMoney.png" alt="">
                        </div>
                        <h3 class="page-title">
                            {{$post->title}}
                        </h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="rating-show">
        <div class="container">
            <form action="{{route('news.update', $post->id)}}" method="POST" enctype="multipart/form-data" class="search-wrap">
                @csrf
                @method('PUT')
                <label for="title" class="search-header news-edit-label">Изображение</label>
                <img src="{{$post->img()}}" style="margin-top: 15px; display: block;" alt="">
                <input type="file" class="search-request" name="img">
                <label for="title" class="search-header news-edit-label">Заголовок</label>
                <input type="text" class="search-request" name="title" value="{{$post->title}}">
                <label for="title" style="margin-bottom: 15px" class="search-header news-edit-label">Текст новости</label>
                <textarea name="description" id="" cols="30" rows="10" class="comment-field">
                    {{$post->description}}
                </textarea>
                <button class="comment-form-btn" type="submit">Сохранить</button>
            </form>
        </div>
    </section>


    @include('includes.footer')
</div>

<div id="photoModal" class="modal">
    <img src="" id="photoModalImg" alt="">
</div>

@include('includes.mobile')
<script src="/assets/js/main.js"></script>
<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    $('.comment-btn').click(function(){
        $('.comment-area').toggleClass('display-n');
    });
    //Modal img
    $('.rating_view_btn').click(function(){
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
