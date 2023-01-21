@if(!\App\Models\AdsOrder::getAds($count)->isEmpty())
    @foreach(\App\Models\AdsOrder::getAds($count) as $ad)
        <a href="{{$ad->link}}" target="_blank"><img src="{{$ad->img}}" alt="{{$ad->img}}"></a>
    @endforeach
@else
    <img src="/assets/img/ads.jpg" alt="">
@endif
