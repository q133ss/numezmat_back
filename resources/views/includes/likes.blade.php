<div class="comment-like" onclick="commentAction('like', '{{$comment->id}}')">
    <img src="/assets/img/thumbs-up.png" alt="">
    {{$comment->likes()}}
</div>
<div class="comment-dislike" onclick="commentAction('dislike', '{{$comment->id}}')">
    <img src="/assets/img/thumbs-down.png" alt="">
    {{$comment->dislikes()}}
</div>
