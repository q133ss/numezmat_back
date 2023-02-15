@if(!\App\Models\AdsOrder::getAds($count)->isEmpty())
    @foreach(\App\Models\AdsOrder::getAds($count) as $ad)
        <a href="{{$ad->link}}" target="_blank"><img src="{{$ad->img}}" alt="{{$ad->img}}"></a>
    @endforeach

    @php
        $qty = \App\Models\AdsOrder::getAds($count)->count();
        $diff = $count-$qty;
    @endphp

    @if($qty < $count)
        @for($i = 0; $i<$diff; $i++)
            <img src="/assets/img/ads.jpg" alt="">
        @endfor
    @endif
@else
    @for($i = 0; $i < $count; $i++)
        <a href="#request-ads" rel="modal:open"><img src="/assets/img/ads.jpg" alt=""></a>
    @endfor
@endif
