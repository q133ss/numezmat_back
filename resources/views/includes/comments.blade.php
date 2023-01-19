<div class="comments">
    @foreach($comments as $comment)
        <div class="comment-block">
            <div class="comment">
                <div class="comment-author">
                    <img src="/assets/img/ava.png" alt="" class="comment-author-avatar">
                    <div class="comment-author-info">
                        <span class="comment-author-nick">
                            {{'@'.$comment->author->name}}
                        </span>
                        <span class="comment-author-date">
                            {{$comment->date()}}
                        </span>
                    </div>
                </div>
                <div class="comment-text">
                    {!! $comment->text !!}
                </div>
                @if($comment->coin)
                    <div class="comment-coin">
                        <span class="comment-coin-count">1</span>
                        {{$comment->coin->title}}
                    </div>
                @endif
                <div class="comment-footer">
                    <div class="comment-likes">
                        <div class="comment-like comment-action" data-id="{{$comment->id}}" data-action="like">
                            <img src="/assets/img/thumbs-up.png" alt="">
                            {{$comment->likes()}}
                        </div>
                        <div class="comment-dislike comment-action" data-id="{{$comment->id}}" data-action="dislike">
                            <img src="/assets/img/thumbs-down.png" alt="">
                            {{$comment->dislikes()}}
                        </div>
                    </div>
                    <div class="comment-footer-right">
                        <button class="comment-answers">
                            Показать ответы
                            <span class="comment-answer-count">
                                    ({{$comment->replies()->count()}})
                            </span>
                        </button>
                        <button class="comment-answer" data-post="{{$postId}}" data-type="{{$type}}" data-reply="{{$comment->id}}">
                            <img src="/assets/img/corner-down-right.png" alt="">
                            Ответить
                        </button>
                    </div>
                </div>
                <div class="for-answer"></div>
            </div>

            @foreach($comment->replies()->get() as $reply)
                <div class="sub-comment display-n">
                    <div class="sub-comment-text">
                        <span class="sub-comment-reply">{{'@'.$reply->replyAuthor()}}, </span>
                        {{$reply->text}}
                    </div>
                    @if($reply->coin)
                        <div class="comment-coin" style="margin-top: 10px;">
                            <span class="comment-coin-count">1</span>
                            {{$reply->coin->title}}
                        </div>
                    @endif
                    <div class="sub-comment-footer">
                        <div class="sub-comment-author">
                            by {{'@'.$comment->author->name}}
                        </div>
                        <div class="fix">
                            <button class="comment-answer" data-post="{{$postId}}" data-type="{{$type}}" data-reply="{{$comment->id}}">
                                <img src="/assets/img/corner-down-right.png" alt="">
                                Ответить
                            </button>
                        </div>
                    </div>
                    <div class="for-answer"></div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
