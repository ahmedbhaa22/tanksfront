<div class="col-md-8 col-sm-8 no-padding">
    <div class="offers-swiper">
        <!-- Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper">

                @if($offers)
                    @foreach($offers as $offer)
                        <div class="swiper-slide">
                            <div class="col-xs-12 no-padding">
                                <a href="{{ url('store/offer-details/'.$offer['id'].'/'.Helpers::str2url($offer['name'])) }}">
                                    <div class="offer-div full-height" style="background-image:url({{ $offer['image'] }})">
                                                    <span class="offer-bar">
                                                <p>{{$offer['name']}}</p>
                                            </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-4 no-padding">
    <div class="ads-swiper swiper-container">
        <div class="swiper-wrapper">
            @if($ads)
                @foreach($ads as $ad)
                    <a class="swiper-slide " href="{{Helpers::getCmsModuleDataItemFromGroup($ad, 'keyvalue', 'link')}}" target="_blank">
                        <div class="ads-div full-height" alt="{{$ad['name']}}" style="background-image:url({{ $ad['image'] }})">
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>