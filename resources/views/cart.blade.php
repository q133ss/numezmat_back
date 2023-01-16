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
            <table class="cart-table">
                <tr>
                    <th style="width: 275px;">Изображение</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th style="width:80px">Колличество</th>
                    <th>Удалить</th>
                </tr>
                <tr>
                    <td>
                        <img class="cart-img" src="/assets/img/cart-place.png" alt="">
                    </td>
                    <td>
                        <span class="cart-title">Пинцет для монет LUXUS</span>
                    </td>
                    <td><span class="cart-title">1350 ₽</span></td>
                    <td>
                        <div class="cart-qty-wrap">
                            <button class="cart-qty-btn" data-action="plus">+</button>
                            <input type="text" class="cart-qty" value="1">
                            <button class="cart-qty-btn" data-action="minus">-</button>
                        </div>
                    </td>
                    <td>
                        <button type="button">
                            <img src="/assets/img/cart-close.png" alt="">
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <img class="cart-img" src="/assets/img/cart-place.png" alt="">
                    </td>
                    <td>
                        <span class="cart-title">Пинцет для монет LUXUS</span>
                    </td>
                    <td><span class="cart-title">1350 ₽</span></td>
                    <td>
                        <div class="cart-qty-wrap">
                            <button class="cart-qty-btn" data-action="plus">+</button>
                            <input type="text" class="cart-qty" value="1">
                            <button class="cart-qty-btn" data-action="minus">-</button>
                        </div>
                    </td>
                    <td>
                        <button type="button">
                            <img src="/assets/img/cart-close.png" alt="">
                        </button>
                    </td>
                </tr>
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
                    Итого: <span class="cart-total-sum">1350 ₽</span>
                </div>

                <button class="comment-form-btn cart-payment-btn">Оплатить</button>
            </form>
        </div>
    </section>

    @include('includes.footer')
</div>

@include('includes.mobile')
<script src="/assets/js/main.js"></script>
<script>
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
</script>
</body>

</html>
