<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заказы</title>
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
                        <li>Мои заказы</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/profile-ico.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Мои заказы
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
                    <table class="cart-table">
                        <tr>
                            <th>Имя</th>
                            <th>Статус</th>
                            <th>Сумма</th>
                            <th>Дата</th>
                            <th>Просмотр</th>
                        </tr>

                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    {{$order->fio}}
                                </td>
                                <td>
                                    <span class="cart-title">{{$order->status}}</span>
                                </td>
                                <td>
                                   {{$order->total}} ₽
                                </td>
                                <td>
                                   {{$order->getDate()}}
                                </td>
                                <td>
                                    <a href="#show" onclick="show('{{$order->id}}')" rel="modal:open" style="color: #3f6695">Просмотр</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
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

    <div id="show" class="modal">
        <span class="post-except">Имя</span>
        <span style="margin-bottom: 10px;" class="search-request" id="name"></span>

        <span class="post-except">Статус</span>
        <span style="margin-bottom: 10px;" class="search-request" id="status"></span>

        <span class="post-except">Итог</span>
        <span style="margin-bottom: 10px;" class="search-request" id="total"></span>

        <span class="post-except">Email</span>
        <span style="margin-bottom: 10px;" class="search-request" id="email"></span>

        <span class="post-except">Создан</span>
        <span style="margin-bottom: 10px;" class="search-request" id="date"></span>

        <span class="post-except">Товары</span>
        <div id="products"></div>
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
    function show(id){
        $.ajax({
            url: "/profile/order/"+id,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#products > .search-request').remove()

                $('#name').text(response.data.name)
                $('#status').text(response.data.status)
                $('#total').text(response.data.total)
                $('#email').text(response.data.email)
                $('#date').text(response.data.date)

                response.data.products.forEach(function (item, i , arr){
                    $('#products').append('<span class="search-request">'+item.title+' (Кол-во: '+item.qty+')</span>')
                });
            },
            error: function(data) {
                //
            }
        });
    }
</script>
</body>
</html>
