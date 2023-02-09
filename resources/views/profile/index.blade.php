<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аккаунт</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
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
                        <li>Мой профиль</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/profile-ico.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Профиль
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
                <div class="profile-content">
                    <div class="profile-img">
                        <img src="{{$user->avatar()}}" class="profile-avatar" alt="">
                        <button type="button" id="change-avatar" class="change-avatar">Заменить фото профиля</button>
                    </div>
                    <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="display-n" id="profile-img" name="img">
                        <div class="profile-form">

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <span class="search-header valid-error">{{ $error }}</span> <br>
                                @endforeach
                            @endif

                            <div class="profile-group">
                                <label>Имя</label>
                                <input type="text" name="name" placeholder="Имя" value="{{$user->name}}">
                            </div>

                            <div class="profile-group">
                                <label>Email</label>
                                <input type="text" name="email" placeholder="Email" value="{{$user->email}}">
                            </div>

                            <div class="profile-group">
                                <label>Старый пароль</label>
                                <input type="password" name="password_old" placeholder="********">
                            </div>

                            <div class="profile-group">
                                <label>Новый пароль</label>
                                <input type="password" name="password_new" placeholder="********">
                            </div>
                        </div>

                        <button class="change-avatar profile-save-btn">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
    $('#change-avatar').click(function (){
        $('#profile-img').click();
    });
</script>
</body>
</html>
