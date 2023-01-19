<div class="comment-like comment-action" data-id="{{$comment->id}}" data-action="like">
    <img src="/assets/img/thumbs-up.png" alt="">
    {{$comment->likes()}}
</div>
<div class="comment-dislike comment-action" data-id="{{$comment->id}}" data-action="dislike">
    <img src="/assets/img/thumbs-down.png" alt="">
    {{$comment->dislikes()}}
</div>
{{--!! нужно функцией! !!--}}
