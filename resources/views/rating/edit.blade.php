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

    /*swiper*/

      .swiper {
          width: 100%;
          height: 100%;
      }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
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
                        <li><a href="{{route('rating.index')}}">Определение и оценка</a></li>
                        @foreach($post->category->getParents() as $category)
                            <li><a href="{{route('rating.show', $category)}}">{{$category->name}}</a></li>
                        @endforeach
                        <li><a href="{{route('rating.show', $post->category->id)}}">{{$post->category->name}}</a></li>
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
            <form action="{{route('rating.update', $post->id)}}" id="edit-form" method="POST" enctype="multipart/form-data" class="search-wrap">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <span class="search-header valid-error">{{ $error }}</span> <br>
                    @endforeach
                @endif

                <label for="title" class="search-header news-edit-label">Изображения</label>
                <!-- Swiper -->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($post->images() as $img)
                        <div class="swiper-slide">
                            <img src="{{$img}}" alt="" style="cursor: pointer" class="edit-imgs">
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
{{--                end Swiper--}}
                <label for="title" class="search-header news-edit-label">Заголовок</label>
                <input type="text" class="search-request" name="title" value="{{$post->title}}">

                <label for="title" style="margin-bottom: 15px" class="search-header news-edit-label">Текст</label>
                <textarea name="description" id="" cols="30" rows="10" class="comment-field">
                    {{$post->description}}
                </textarea>
                <input type="file" id="qwe">
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
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    $('.edit-imgs').click(function (){
        //передаем файл
        let file_data = $('#qwe').prop('files')[0];
        if(file_data != undefined) {
            let form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('src', $(this).attr('src'));
            form_data.append('id', '{{$post->id}}');
            let th = $(this);

            $.ajax({
                url: "/rating/change-file",
                type: "POST",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                success: function (response) {
                    console.log($(this).attr('src'))
                    th.attr('src', response);
                },
            });
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
