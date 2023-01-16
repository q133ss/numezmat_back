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
                        <a href="#">Магазин</a>
                        <i class="fa fa-angle-down"></i>

                        <ul class="sub-menu">
                            <li>Меню 1</li>
                            <li>Меню 2</li>
                            <li>Меню 3</li>
                        </ul>
                    </li>

                    <li class="menu-item has-child">
                        <a href="#">Библиотека</a>
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
                            <span>
                                    0
                                </span>
                        </button>
                    </li>

                    <li>
                        <a href="#" class="header-search"><i class="fa fa-search"></i></a>
                    </li>
                </ul>
                <span class="menu-burger" onclick="mobileMenu()">
                        <i class="fa fa-bars"></i>
                    </span>
            </nav>
        </div>
    </div>
</header>
