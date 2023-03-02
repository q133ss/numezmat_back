<div id="request-ads" class="modal">
    <h3 class="post-title">Оставить заявку на рекламу</h3>

    <div id="ads-error" style="color: red"></div>

    <label for="type" class="search-header news-edit-label" style="display:block; padding-top: 12px;">Где бы вы хотели разместить рекламу</label>
    <select name="type" class="search-request" id="ads_type">
        <option value="here">Только на этой странице</option>
        <option value="all">Во всей категории</option>
    </select>
    <label class="search-header news-edit-label" style="display:block; padding-top: 12px;" for="img">Изображение</label>
    <input type="file" id="ads_img" class="search-request" name="img">

    <label class="search-header news-edit-label" style="display:block; padding-top: 12px;" for="img">Ссылка</label>
    <input type="text" id="ads_link" class="search-request" name="link">

    <label class="search-header news-edit-label" style="display:block; padding-top: 12px;" for="img">Ваш телефон</label>
    <input type="text" id="ads_phone" class="search-request" name="phone">

    <button class="other-theme-btn" style="margin-top: 12px;" type="button" id="adsSendBtn" onclick="adsSend()">Отправить</button>
</div>

<footer>
    <div class="container">
        <div class="footer-row">
            <div class="footer-col">

                <p class="footer-desc">
                    Нумизмат - Онлайн платформа поклонников нумизматики
                </p>
                <ul class="footer-contact">
                    <li><i class="fa fa-map-marker"></i>Москва, Улица Дорог, Дом 1</li>
                    <li><i class="fa fa-phone"></i>+7(495)123-45-67</li>
                    <li><i class="fa fa-envelope-o"></i>info@numizmat.ru</li>
                </ul>
            </div>

            <div class="footer-col">
                <h3 class="footer-title">Полезные ссылки</h3>
                <div class="footer-links">
                    <a href="#" class="footer-link-item"><i class="fa fa-caret-right"></i>Главная</a>
                    <a href="#" class="footer-link-item"><i class="fa fa-caret-right"></i>О нас</a>
                    <a href="#" class="footer-link-item"><i class="fa fa-caret-right"></i>Аукцион</a>

                    <a href="#" class="footer-link-item"><i class="fa fa-caret-right"></i>Политика</a>
                    <a href="#" class="footer-link-item"><i class="fa fa-caret-right"></i>Правила</a>
                    <a href="#" class="footer-link-item"><i class="fa fa-caret-right"></i>Реклама</a>
                </div>
            </div>

            <div class="footer-col">
                <div class="footer-ads_block">
                    @include('includes.ad', ['count' => 1, 'in_footer' => 1])
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright">
    <div class="container">
        <div class="pre-footer-row">
            <div class="pre-footer-col">
                <p class="copyright-text">Copyrights 2021 <em>Нумизматика</em>. Сделано с любовью в <a href="https://bpump.ru/" target="_blank" style="color: #fff;">bpump.ru</a> </p>
            </div>
            <div class="pre-footer-col">
                <ul class="copyright-links">
                    <li><a href="/">Главная</a></li>
                    <li><a href="#">О проекте</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter">Аукцион</a></li>
                    <li><a href="#">Беседка</a></li>
                    <li><a href="#">Контакты</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>

    $('.view-img').click(function (){
        let path = $(this).attr('src');
        $('#photoModalImg').attr('src', path);
        $('#photoModal').modal('show');
    });

    function adsSend(in_footer = 0){
        let img = $('#ads_img').prop('files')[0];
        let form_data = new FormData();
        form_data.append('type', $('#ads_type').val());
        form_data.append('img', img);
        form_data.append('link', $('#ads_link').val());
        form_data.append('phone', $('#ads_phone').val());
        form_data.append('page_url', '{{URL()->current()}}');
        form_data.append('in_footer', in_footer);
        form_data.append('category', '{{stristr(\Request::route()->getName(),'.', true)}}');

        $.ajax({
            url: "/ads/send",
            type: "POST",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: form_data,
            success: function (response) {
                //тут меняем хтмл формы
                $('#request-ads').html('<h3>Заявка успешно отправлена, мы свяжемся с вами в ближайшее время</h3>');
            },
            error: function(data) {
                var response = JSON.parse(data.responseText);
                var errorString = '';
                $.each( response.errors, function( key, value) {
                    errorString += value+'<br>';
                });
                $('#ads-error').html(errorString);
            }
        });
    }

    $('#sortSelect').change(function (){
        $(this).parent().submit();
    });

    $('.comment-answer').click(function (){
        let post_id = $(this).data('post');
        let type = $(this).data('type');
        let reply_id = $(this).data('reply') || '';

        let mainBlock = $(this).parent().parent().parent().find('.for-answer');
        if(mainBlock.find('.comment-area').length > 0){
            mainBlock.find('.comment-area').remove();
        }else{
            mainBlock.append(
                '<div class="comment-area">' +
                '@if(Auth()->check())' +
                '<div class="comment-avatar-block">' +
                '<img src="/assets/img/Ellipse66.png" class="comment-avatar" alt="">' +
                '<div class="comment-nick">' +
                '{{ '@'.Auth()->user()->name }}' +
                '</div>' +
                '</div>' +
                '<form action="{{route('comment.send')}}" method="POST" class="comment-form">' +
                '@csrf' +
                '<input type="hidden" name="type" value="'+type+'">'+
                '<input type="hidden" name="post_id" value="'+post_id+'">'+
                '<input type="hidden" name="reply_id" value="'+reply_id+'">'+
                '<select name="coin_id" id="" class="comment-select-coin">' +
                @foreach(Auth()->user()->coins as $coin)
                '<option value="{{$coin->id}}">{{$coin->title}}</option>'+
                @endforeach
                '<option value="" selected disabled>Прикрепить монету</option>' +
                '</select>' +
                '<textarea name="text" id="" class="comment-field" cols="100" rows="10"' +
                'placeholder="Ваш коментарий"></textarea>' +
                '<div class="comment-form-btn-wrap">' +
                '<button class="comment-form-btn">Опубликовать</button>' +
                '</div>' +
                '</form>' +
                '@else' +
                '<span class="comment-text">Необходимо <a href="{{route('login')}}">войти</a>, что бы оставлять комментарии</span>' +
                '@endif' +
                '</div>'
            );
        }
    });

    $('.comment-answers').click(function (){
        $(this).parent().parent().parent().parent().find('.sub-comment').toggleClass('display-n');
    });

    function commentAction (action, post_id){
        let comment = $('#likes-'+post_id);

        $.ajax({
            url: "/comment/action",
            type: "POST",
            data: {'comment_id':post_id, 'action':action},
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data) {
            comment.html(data);
        });
    }
</script>
<style>
    .valid-error{
        color: #CB3631;
    }

    .comment-like, .comment-dislike{
        cursor: pointer;
    }

    .post-content{
        width: 100%;
        justify-content: space-between;
    }
</style>
