<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$product->title}}</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/752l8byduhddjuj8adfjo4ntwolgqwjrr1bhlxn26marh09g/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <style>
        .detail_slider {
            padding: 10px 16px;
            color: #fff;
            box-sizing: border-box;
            width: 100%;
            overflow: hidden;
            background-color: #F3F7FA;
        }

        .detail_slider .swiper-container {
            width: 100%;
            height: 100%;
        }

        .slider__flex {
            display: flex;
            align-items: flex-start;
        }

        .slider__col {
            display: flex;
            flex-direction: column;
            width: 150px;
            margin-left: 13px;
        }

        .slider__prev,
        .slider__next {
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .slider__prev:focus,
        .slider__next:focus {
            outline: none;
        }

        .slider__thumbs {
            height: calc(400px - 96px);
        }

        .slider__thumbs .slider__image {
            transition: 0.25s;
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
            opacity: 0.5;
        }

        .slider__thumbs .slider__image:hover {
            opacity: 1;
        }

        .slider__thumbs .swiper-slide-thumb-active .slider__image {
            -webkit-filter: grayscale(0%);
            filter: grayscale(0%);
            opacity: 1;
        }

        .slider__images {
            height: 327px;
        }

        .slider__images .slider__image img {
            transition: 3s;
        }

        .slider__images .slider__image:hover img {
            transform: scale(1.1);
        }

        .slider__image {
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 4px;
        }

        .slider__image img {
            display: block;
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        @media (max-width: 767.98px) {
            .slider__flex {
                flex-direction: column-reverse;
            }

            .slider__col {
                flex-direction: row;
                align-items: center;
                margin-right: 0;
                margin-top: 24px;
                width: 100%;
            }

            .slider__images {
                width: 100%;
            }

            .slider__thumbs {
                height: 100px;
                width: calc(100% - 96px);
                margin: 0 16px;
            }

            .slider__prev,
            .slider__next {
                height: auto;
                width: 32px;
            }
        }
    </style>
</head>

<body>

@include('includes.header')

<div class="page-content">

    <section class="page-header">
        <div class="container">
            <div class="page-header-wrap">
                <div class="page-header-left">
                    <ul class="breadcrumbs">
                        <li><a href="/">??????????????</a></li>
                        <li><a href="{{route('shop.index')}}">??????????????</a></li>
                        @foreach($product->category->getParents() as $cat)
                            <li><a href="{{route('shop.show', $cat)}}">{{$cat->name}}</a></li>
                        @endforeach
                        <li><a href="{{route('shop.show', $product->category->id)}}">{{$product->category->name}}</a></li>
                        <li>{{$product->title}}</li>
                    </ul>
                    <div class="page-title-block">
                        <h3 class="page-title">
                            {{$product->title}}
                        </h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="rating-show">
        <div class="container">
            <div class="rating-show-content">
                <div class="rating-show-info">
                    <!-- SWIPER GALLERY -->
                    <section class="detail_slider">
                        <div class="container">
                            <div class="slider__flex">
                                <div class="slider__images">
                                    <div class="swiper-container"> <!-- ?????????????? ?? ?????????????????????????? -->
                                        <div class="swiper-wrapper">
                                            @foreach($product->images() as $img)
                                            <div class="swiper-slide">
                                                <div class="slider__image">
                                                    <img src="{{$img}}" alt="" />
                                                    <div class="rating_view_btn"><a rel="modal:open"
                                                                                    href="#photoModal">?????????????? ????????????????</a></div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="slider__col">

                                    <div class="slider__thumbs">
                                        <div class="swiper-container"> <!-- ?????????????? ?? ???????????? -->
                                            <div class="swiper-wrapper">
                                                @foreach($product->images() as $img)
                                                <div class="swiper-slide">
                                                    <div class="slider__image"><img
                                                            src="{{$img}}" alt="" />
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>
                    <!-- END SWIPER GALLERY -->
                    <div class="rating-show-info-block">
                        <div class="catalog-data">
                            <h3>????????????????????????????</h3>
                            @foreach($product->characteristics->chunk(2) as $chunk)
                            <div class="catalog-char-wrap">
                                @foreach($chunk as $characteristic)
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">{{$characteristic->name}}:</div>
                                    <div class="cat-char-val">{{$characteristic->value}}</div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach

                            <div class="catalog-char-wrap">
                                <div class="catalog-char-item">
                                    <div class="cat-char-key">????????:</div>
                                    <div class="cat-char-val">{{$product->price}}</div>
                                </div>
                            </div>

                            <h3>????????????????</h3>
                            {!! $product->description !!}
                            <button class="other-theme-btn" style="margin-top: 20px" id="add-to-cart-btn">???????????????? ?? ??????????????</button>
                        </div>
                    </div>
                </div>

                <div class="rating-show-control">
                    @can('edit-shop')
                        <a href="{{route('shop.edit', $product->id)}}" class="rating-show-edit-btn">?????????????????????????? ???????? <img src="/assets/img/Edit_fill.png" alt=""></a>
                    @endcan

                    @can('block-shop')
                        @if($product->is_block == 0)
                            <a href="{{route('shop.block', ['id' => $product->id, 'action' => 1])}}" class="rating-show-block-btn">?????????????????????????? ????????</a>
                        @else
                            <a href="{{route('shop.block', ['id' => $product->id, 'action' => 0])}}" class="rating-show-block-btn comment-form-btn">???????????????????????????? ????????</a>
                        @endif
                    @endcan
                </div>

            </div>
            <div class="rating-show-wrapper">
                <div class="rating-show-content">


                    <h4 class="rating-show-other-themes">???????????????? ??????????????????????</h4>
                    <button class="comment-form-btn comment-btn">????????????????????????????????</button>
                    <div class="comment-area display-n">
                        @if(Auth()->check())
                            <div class="comment-avatar-block">
                                <img src="/assets/img/Ellipse66.png" class="comment-avatar" alt="">
                                <div class="comment-nick">
                                    {{'@'.Auth()->user()->name}}
                                </div>
                            </div>
                            <form action="{{route('comment.send', ['type' => 'product','post_id' => $product->id])}}" method="POST" class="comment-form">
                                @csrf
                                <select name="coin_id" id="" class="comment-select-coin">
                                    <option value="" selected disabled>???????????????????? ????????????</option>
                                    @foreach(Auth()->user()->coins as $coin)
                                        <option value="{{$coin->id}}">{{$coin->title}}</option>
                                    @endforeach
                                </select>
                                <textarea name="text" id="" class="comment-field" cols="100" rows="10"
                                          placeholder="?????? ????????????????????"></textarea>
                                <div class="comment-form-btn-wrap">
                                    <button class="comment-form-btn">????????????????????????</button>
                                </div>
                            </form>
                        @else
                            <span class="comment-text">???????????????????? <a href="{{route('login')}}">??????????</a>, ?????? ???? ?????????????????? ??????????????????????</span>
                        @endif
                    </div>
                    @include('includes.comments', ['comments' => $product->comments, 'type' => 'product', 'postId' => $product->id])
                </div>
                <div class="rating-show-sidebar">
                    <div class="rating-show-sidebar-wrap">
                        @foreach($product->relatedPosts() as $post)
                            <div class="sidebar-other-theme">
                                <img src="{{$post->img()}}" class="other-theme-img" alt="">
                                <h3 class="other-theme-title">{{$post->title}}</h3>
                                <p class="other-theme-text">
                                    {{mb_substr($post->description, 0, 37)}}
                                    @if(mb_strlen($post->description) > 37)...@endif
                                </p>
                                <a href="{{route('shop.detail', $post->id)}}" class="other-theme-btn">??????????????????</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('includes.footer')
</div>

@include('includes.mobile')
<div id="photoModal" class="modal">
    <img src="" id="photoModalImg" alt="">
</div>

<!-- ---- -->
<script src="/assets/js/main.js"></script>
<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

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

    $('#add-to-cart-btn').click(function (){
        $.ajax({
            url: "/add-to-cart/{{$product->id}}",
            type: "POST",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data) {
            updateCartCount()
            $('#add-to-cart-btn').text('?????????????????? ?? ??????????????!')
        });
    });

    $('.comment-btn').click(function(){
        $('.comment-area').toggleClass('display-n');
    });
    //Modal img
    $('.rating_view_btn').click(function () {
        let path = $(this).parent().parent().find('img').attr('src');
        $('#photoModalImg').attr('src', path);
    });

    //Swiper
    // ?????????????????????????? ???????????? ????????????????
    const sliderThumbs = new Swiper('.slider__thumbs .swiper-container', { // ???????? ?????????????? ???????????? ???? ??????????????????
        // ???????????? ??????????????????
        direction: 'vertical', // ???????????????????????? ??????????????????
        slidesPerView: 3, // ???????????????????? ???? 3 ????????????
        spaceBetween: 24, // ???????????????????? ?????????? ????????????????
        mousewheel: true,
        navigation: { // ???????????? ???????????? ??????????????????
            nextEl: '.slider__next', // ???????????? Next
            prevEl: '.slider__prev' // ???????????? Prev
        },
        freeMode: true, // ?????? ???????????????????????????? ???????????? ?????????? ???????? ?????? ?????? ??????????????
        breakpoints: { // ?????????????? ?????? ???????????? ???????????????? ???????? ????????????????
            0: { // ?????? 0px ?? ????????
                direction: 'horizontal', // ???????????????????????????? ??????????????????
            },
            768: { // ?????? 768px ?? ????????
                direction: 'vertical', // ???????????????????????? ??????????????????
            }
        }
    });
    // ?????????????????????????? ???????????????? ??????????????????????
    const sliderImages = new Swiper('.slider__images .swiper-container', { // ???????? ?????????????? ???????????? ???? ??????????????????
        // ???????????? ??????????????????
        direction: 'vertical', // ???????????????????????? ??????????????????
        slidesPerView: 1, // ???????????????????? ???? 1 ??????????????????????
        spaceBetween: 72, // ???????????????????? ?????????? ????????????????
        mousewheel: true, // ?????????? ???????????????????????? ?????????????????????? ?????????????????? ????????

        grabCursor: true, // ???????????? ???????????? ??????????????
        thumbs: { // ?????????????????? ???? ???????????? ??????????????
            swiper: sliderThumbs // ?????????????????? ?????? ???????????? ????????????????
        },
        breakpoints: { // ?????????????? ?????? ???????????? ???????????????? ???????? ????????????????
            0: { // ?????? 0px ?? ????????
                direction: 'horizontal', // ???????????????????????????? ??????????????????
            },
            768: { // ?????? 768px ?? ????????
                direction: 'vertical', // ???????????????????????? ??????????????????
            }
        }
    });
</script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            renderBullet: function (index, className) {
                return '<button class="slider-paginate ' + className + '"></button>';
            }
        }
    });

    var swiper = new Swiper(".posts-slider", {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            900: {
                slidesPerView: 1,
            },
            650: {
                slidesPerView: 1,
            },
            350: {
                slidesPerView: 1,
            }
        }
    });

    var swiper = new Swiper(".news-slider", {
        slidesPerView: 2,
        spaceBetween: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            1250: {
                slidesPerView: 1,
            },
            350: {
                slidesPerView: 1,
            }
        }
    });
</script>

<script>
    tinymce.init({
        selector: '.comment-field',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        language: 'ru',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ]
    });
</script>
</body>

</html>
