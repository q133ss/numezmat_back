<div class="posts-paginate">
    <ul>
        @foreach ($elements as $element)
            @if (is_string($element))
                <li style="color:#B1B1B1;"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="current-page">{{$page}}</li>
                    @else
                        <li><a href="{{$url}}">{{$page}}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
</div>
