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
                @if(Auth()->check())
                    <li><a href="{{route('profile.index')}}">{{Auth()->user()->name}}</a></li>
                @else
                    <li><a href="{{route('login')}}">Вход</a></li>
                    <li><a href="{{route('register')}}">Регистрация</a></li>
                @endif
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
                            @foreach(\App\Models\Category::getMainCategories('App\Models\Catalog')->get() as $category)
                            @if(\App\Models\Category::where('parent_id', $category->id)->exists())
                                <li class="sub-has-child" onclick="location.href='{{route('catalog.show', $category->id)}}'" style="cursor: pointer">
                                    {{$category->name}}
                                    <ul class="sub-sub-menu">
                                        @foreach(\App\Models\Category::where('parent_id', $category->id)->limit(4)->get() as $subcat)
                                        <li>
                                            <a href="{{route('catalog.show', $subcat->id)}}">
                                                {{$subcat->name}}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li onclick="location.href='{{route('catalog.show', $category->id)}}'" style="cursor: pointer">{{$category->name}}</li>
                            @endif
                            @endforeach

                        </ul>
                    </li>

                    <li class="menu-item has-child">
                        <a href="{{route('shop.index')}}">Магазин</a>
                        <i class="fa fa-angle-down"></i>

                        <ul class="sub-menu">
                            @foreach(\App\Models\Category::getMainCategories('App\Models\Shop')->get() as $category)
                                @if(\App\Models\Category::where('parent_id', $category->id)->exists())
                                    <li class="sub-has-child" onclick="location.href='{{route('shop.show', $category->id)}}'" style="cursor: pointer">
                                        {{$category->name}}
                                        <ul class="sub-sub-menu">
                                            @foreach(\App\Models\Category::where('parent_id', $category->id)->limit(4)->get() as $subcat)
                                                <li>
                                                    <a href="{{route('shop.show', $subcat->id)}}">
                                                        {{$subcat->name}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li onclick="location.href='{{route('shop.show', $category->id)}}'" style="cursor: pointer">{{$category->name}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li>

                    <li class="menu-item has-child">
                        <a href="{{route('library.index')}}">Библиотека</a>
                        <i class="fa fa-angle-down"></i>

                        <ul class="sub-menu">
                            @foreach(\App\Models\Category::getMainCategories('App\Models\Library')->get() as $category)
                                @if(\App\Models\Category::where('parent_id', $category->id)->exists())
                                    <li class="sub-has-child" onclick="location.href='{{route('library.show', $category->id)}}'" style="cursor: pointer">
                                        {{$category->name}}
                                        <ul class="sub-sub-menu">
                                            @foreach(\App\Models\Category::where('parent_id', $category->id)->limit(4)->get() as $subcat)
                                                <li>
                                                    <a href="{{route('library.show', $subcat->id)}}">
                                                        {{$subcat->name}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li onclick="location.href='{{route('library.show', $category->id)}}'" style="cursor: pointer">{{$category->name}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="{{route('forum.index')}}">Беседка</a>
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
