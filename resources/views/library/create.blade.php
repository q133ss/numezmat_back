<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить запить в библиотеку</title>
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

@include('includes.header')

<div class="page-content">

    <section class="page-header">
        <div class="sw_container">
            <div class="page-header-wrap">
                <div class="page-header-left">
                    <ul class="breadcrumbs">
                        <li><a href="/">Главная</a></li>
                        <li>Добавить запись в библиотеку</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/revMyMoney.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Добавить запись
                        </h3>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="rating-show">
        <div class="container">
            <form action="{{route('library.store')}}" id="edit-form" method="POST" enctype="multipart/form-data" class="search-wrap">
                @csrf

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <span class="search-header valid-error">{{ $error }}</span> <br>
                    @endforeach
                @endif

                <label for="title" class="search-header news-edit-label">Изображение</label>
                <input type="file" class="search-request" multiple name="img[]" value="{{old('img[]')}}">

                <label for="title" class="search-header news-edit-label">Категория</label>
                <select name="category_id" class="search-request" id="">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if(\Request()->category_id == $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>

                <label for="name" class="search-header news-edit-label">Заголовок</label>
                <input type="text" class="search-request" name="name" value="{{old('name')}}">

                <label for="title" style="margin-bottom: 15px" class="search-header news-edit-label">Текст</label>
                <textarea name="description" id="" cols="30" rows="10" class="comment-field">{{old('description')}}</textarea>

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
</body>

</html>
