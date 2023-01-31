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
                <div class="footer-ads">
                    <img src="/assets/img/ads.jpg" alt="">
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
