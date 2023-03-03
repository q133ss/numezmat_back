<!-- Mobile menu -->
<div class="mob-menu-popup display-n" id="mob-menu-popup">
    <div class="mob-menu-popup-content">
        <div id="close-mob-menu" onclick="closeMenu()">
                <span>
                    X
                </span>
        </div>
        <ul>
            <li>
                <a href="{{route('news.index')}}">Новости</a>
            </li>
            <li>
                <a href="{{route('rating.index')}}">Определение и оценка</a>
            </li>
            <li>
                <a href="{{route('expertise.index')}}">Экспертиза</a>
            </li>
            <li>
                <a href="{{route('catalog.index')}}">Каталог</a>
            </li>
            <li>
                <a href="{{route('shop.index')}}">Магазин</a>
            </li>
            <li>
                <a href="{{route('library.index')}}">Библиотека</a>
            </li>
            <li>
                <a href="{{route('forum.index')}}">Беседка</a>
            </li>
        </ul>
    </div>
</div>
<!-- ---- -->
