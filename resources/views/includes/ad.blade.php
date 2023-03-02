@if(!\App\Models\AdsOrder::getAds($count)->isEmpty())
{{--
        Берем те, которые на всю категори
        Затем, если есть та, которая конкретно на эту страницу, мы ее перебиваем
--}}
    @foreach(\App\Models\AdsOrder::getAds($count) as $ad)
        <a href="{{$ad->link}}" target="_blank"><img src="{{$ad->img}}" alt="{{$ad->img}}"></a>
    @endforeach

    @php
        $qty = \App\Models\AdsOrder::getAds($count)->count();
        $diff = $count-$qty;
    @endphp

    @if($qty < $count)
        @for($i = 0; $i<$diff; $i++)
            <a @if(isset($in_footer)) onclick="$('#adsSendBtn').attr('onclick', 'adsSend(1)')" @else onclick="$('#adsSendBtn').attr('onclick', 'adsSend()')" @endif href="#request-ads" rel="modal:open"><img src="/assets/img/ads.jpg" alt=""></a>
        @endfor
    @endif
@else
    @for($i = 0; $i < $count; $i++)
        <a @if(isset($in_footer)) onclick="$('#adsSendBtn').attr('onclick', 'adsSend(1)')" @else onclick="$('#adsSendBtn').attr('onclick', 'adsSend()')" @endif href="#request-ads" rel="modal:open"><img src="/assets/img/ads.jpg" alt=""></a>
    @endfor
@endif
