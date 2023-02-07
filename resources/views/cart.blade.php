<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <li>Корзина</li>
                    </ul>
                    <div class="page-title-block">
                        <div class="page-img">
                            <img src="/assets/img/cart-icone.png" alt="">
                        </div>
                        <h3 class="page-title">
                            Корзина
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-wrap">
        <div class="container">
            @if(session('cart'))
            <table class="cart-table">
                <tr>
                    <th style="width: 275px;">Изображение</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th style="width:80px">Колличество</th>
                    <th>Удалить</th>
                </tr>

                @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php
                            $total += $details['price'] * $details['qty']
                        @endphp
                        <tr id="cart-item_{{$id}}">
                            <td>
                                <img class="cart-img" src="{{$details['img']}}" alt="">
                            </td>
                            <td>
                                <span class="cart-title">{{$details['name']}}</span>
                            </td>
                            <td><span class="cart-title">{{$details['price']}} ₽</span></td>
                            <td>
                                <div class="cart-qty-wrap">
                                    <button class="cart-qty-btn" onclick="addToCart('{{$id}}')" data-action="plus">+</button>
                                    <input type="text" disabled class="cart-qty" value="{{$details['qty']}}">
                                    <button class="cart-qty-btn" onclick="removeFromCart('{{$id}}')">-</button>
                                </div>
                            </td>
                            <td>
                                <button type="button" onclick="removeCartItem('{{$id}}')">
                                    <img src="/assets/img/cart-close.png" alt="">
                                </button>
                            </td>
                        </tr>
                    @endforeach
            </table>

            <form action="" class="cart-form">
                <h3 class="characteristics-title">Оформить заказ</h3>
                <div class="cart-form-wrap">
                    <div class="login-group">
                        <label>Имя</label>
                        <input type="text" placeholder="Имя">
                    </div>

                    <div class="login-group">
                        <label>Телефон</label>
                        <input type="text" placeholder="Телефон">
                    </div>

                    <div class="login-group">
                        <label>Email</label>
                        <input type="text" placeholder="Email">
                    </div>

                    <div class="login-group">
                        <label>Адрес</label>
                        <input type="text" placeholder="Адрес">
                    </div>
                </div>

                <div class="cart-total">
                    Итого: <span class="cart-total-sum">{{$total}} ₽</span>
                </div>

                <button class="comment-form-btn cart-payment-btn">Оплатить</button>
            </form>
            @else
                <div class="post-title">В корзине пусто.</div><a class="page-header-sort" href="{{route('shop.index')}}">В магазин</a>
            @endif
        </div>
    </section>

    @include('includes.footer')
</div>

@include('includes.mobile')
<script src="/assets/js/main.js"></script>
<script>
    function updateCartCount(){
        $.ajax({
            url: "/get-cart-count",
            type: "POST",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data) {
            $('#cart-count').text(data);
        });
    }

    $('.cart-qty-btn').click(function () {
        let input = $(this).parent().find('input');
        let cur = parseInt(input.val())
        if ($(this).data('action') == 'plus') {
            input.val(cur + 1);
        } else {
            if (cur > 1) {
                input.val(cur - 1);
            }
        }
    });

    function addToCart(id){
        $.ajax({
            url:"add-to-cart/"+id,
            type: "POST",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (data){
            getTotal();
        });
    }

    function removeFromCart(id){
        $.ajax({
            url:"update-cart",
            type: "POST",
            data: {
                "id": id,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (data){
            getTotal();
        });
    }

    function getTotal(){
        //get-total-cart
        $.ajax({
            url:"get-total-cart",
            type: "POST",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (data){
            $('.cart-total-sum').html(data+' ₽');
        });
    }

    function removeCartItem(id){
        $.ajax({
            url:"delete-from-cart/"+id,
            type: "POST",
            data: {
                "id": id,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (data){
            $('#cart-item_'+id).remove()
            updateCartCount();
            getTotal();
        });
    }
</script>
</body>

</html>
