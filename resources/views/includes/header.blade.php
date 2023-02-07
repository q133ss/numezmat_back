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
                <li><a href="{{route('login')}}">Вход</a></li>
                <li><a href="{{route('register')}}">Регистрация</a></li>
            </ul>
        </div>
    </div>
</div>
<header>
    <div class="container">
        <div class="header-wrap">
            <div class="logo">
                <a href="/">
                    <img src="/assets/img/logo.png" alt="">
                </a>
            </div>
            <nav>
                <ul class="header-menu">
                    <li class="menu-item">
                        <a href="{{route('news.index')}}">Новости</a>
                    </li>

                    <li class="menu-item">
                        <a href="{{route('rating.index')}}">Определение и оценка</a>
                    </li>

                    <li class="menu-item">
                        <a href="{{route('expertise.index')}}">Экспертиза</a>
                    </li>

                    <li class="menu-item has-child">
                        <a href="{{route('catalog.index')}}">Каталог</a>
                        <i class="fa fa-angle-down"></i>

                        <ul class="sub-menu">
                            <li class="sub-has-child">
                                Меню 1
                                <ul class="sub-sub-menu">
                                    <li><a href="#">Под меню 1</a></li>
                                    <li><a href="#">Под меню 1</a></li>
                                </ul>
                            </li>
                            <li>Меню 2</li>
                            <li>Меню 3</li>
                        </ul>
                    </li>

                    <li class="menu-item has-child">
                        <a href="{{route('shop.index')}}">Магазин</a>
                        <i class="fa fa-angle-down"></i>

                        <ul class="sub-menu">
                            <li>Меню 1</li>
                            <li>Меню 2</li>
                            <li>Меню 3</li>
                        </ul>
                    </li>

                    <li class="menu-item has-child">
                        <a href="{{route('library.index')}}">Библиотека</a>
                        <i class="fa fa-angle-down"></i>

                        <ul class="sub-menu">
                            <li>Меню 1</li>
                            <li>Меню 2</li>
                            <li>Меню 3</li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="#">Беседка</a>
                    </li>

                    <li class="menu-item">
                        <button class="header-cart" onclick="location.href='{{route('cart.index')}}'">
                            <i class="fa fa-shopping-cart"></i>
                            <span id="cart-count">
                                @if(session('cart') != null)
                                {{count(session('cart'))}}
                                @else
                                    0
                                @endif
                            </span>
                        </button>
                    </li>

                    <li>
                        <a href="{{route('search')}}" class="header-search"><i class="fa fa-search"></i></a>
                    </li>
                </ul>
                <span class="menu-burger" onclick="mobileMenu()">
                        <i class="fa fa-bars"></i>
                    </span>
            </nav>
        </div>
    </div>
</header>
