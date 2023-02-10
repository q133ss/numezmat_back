<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои монеты</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
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
        <div class="container">
            <div class="page-header-wrap">
                <div class="page-header-left">
                    <ul class="breadcrumbs">
                        <li><a href="/">Главная</a></li>
                        <li>Мои монеты</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/profile-ico.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Мои монеты
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-wrap">
        <div class="container">
            <div class="profile-wrap">
                <ul class="profile-menu">
                    <li>
                        <a href="{{route('profile.index')}}">
                            Настройки профиля
                        </a>
                    </li>

                    <li>
                        <a href="{{route('profile.money')}}">
                            Мои монеты
                        </a>
                    </li>

                    <li>
                        <a href="{{route('profile.orders')}}">
                            Мои заказы
                        </a>
                    </li>
                </ul>

                <div class="profile-content" style="display: block">
                    <div class="">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <span class="search-header valid-error">{{ $error }}</span> <br>
                            @endforeach
                        @endif
                    </div>
                    <table class="cart-table">
                        <tr>
                            <th style="width: 275px;">Изображение</th>
                            <th>Название</th>
                            <th>Действие</th>
                        </tr>

                        @foreach($coins as $coin)
                            <tr>
                                <td>
                                    <img class="cart-img" src="{{$coin->img()}}" alt="">
                                </td>
                                <td>
                                    <span class="cart-title">{{$coin->title}}</span>
                                </td>
                                <td>
                                    <div style="display: flex">
                                        <a onclick="getCoin('{{$coin->id}}')" rel="modal:open" href="#edit" style="color: #3f6695;padding-right: 10px;">
                                            Изменить
                                        </a>
                                        <form action="{{route('profile.coin.delete', $coin->id)}}" method="POST" style="display: flex">
                                            @method('DELETE')
                                            @csrf
                                        <button type="submit">
                                            <img src="/assets/img/cart-close.png" alt="">
                                        </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <a rel="modal:open" href="#create" style="margin-top: 0" class="comment-form-btn">Добавить</a>
                </div>
            </div>
        </div>
    </section>

    <div id="edit" class="modal">
        <form action="{{route('profile.coin.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="#">Изображение</label>
            <input type="file" name="img" class="search-request">
            <label for="#" style="display:block;margin-top: 10px">Название</label>
            <input type="text" name="title" id="coin_name" class="search-request">
            <label for="#" style="display:block;margin-top: 10px">Описание</label>
            <input type="text" name="description" id="coin_description" class="search-request">
            <input type="hidden" name="id" id="coin_id">
            <button type="submit" class="comment-form-btn">Сохранить</button>
        </form>
    </div>

    <div id="create" class="modal">
        <form action="{{route('profile.coin.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="#">Изображение</label>
            <input type="file" name="img" class="search-request">
            <label for="#" style="display:block;margin-top: 10px">Название</label>
            <input type="text" name="title" value="{{old('title')}}" class="search-request">
            <label for="#" style="display:block;margin-top: 10px">Описание</label>
            <input type="text" name="description" value="{{old('description')}}" class="search-request">
            <button type="submit" class="comment-form-btn">Сохранить</button>
        </form>
    </div>

    @include('includes.footer')
</div>

<!-- Mobile menu -->
@include('includes.mobile')
<!-- ---- -->
<script src="/assets/js/main.js"></script>
<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    function getCoin(id){
        $.ajax({
            url: "/profile/coin/"+id,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#coin_name').val(response.data.title)
                $('#coin_description').val(response.data.description)
                $('#coin_id').val(response.data.id)
            },
            error: function(data) {
                //
            }
        });
    }
</script>
</body>
</html>
