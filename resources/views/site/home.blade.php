@extends('template')

@section('title', 'Home')

@section('content')
    <div class="container-fluid no-padding page-body">
<div class="container">

    <!-- Load messages -->
@include('partials._messages')

<!-- Load offers and ads block -->
    @include('partials._offerAds', ['offers' => $offers, 'ads' => $ads])
    <div class="clearfix"></div>

</div>
<div class="container">
    
    <div class="col-md-12">
        <h4 class="uppercase main-title">
            {{__('_site_home.categories_services')}}
            <span class="pull-right"></span>
        </h4>
        <div class="category-home swiper-container">
            <div class="swiper-wrapper">

                @if(count($productCategories))
                    @foreach($productCategories as $cat)
                        <a href="{{ url('product-category/'.$cat['id'].'/'.Helpers::str2url($cat['name'])) }}" class="swiper-slide category-one">
                            <div class="cat-img" style="background-image:url('{{ $cat['image'] }}')">
                            </div>
                            <div class="cat-desc">
                                <h2>{{ $cat['name'] }}</h2>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <hr>
        

    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <h4 class="uppercase main-title">
            {{__('_site_home.most_selling_services')}}
            <span class="pull-right"></span>
        </h4>
        <div class="col-xs-12 gap">
            <div class="category-two-swiper-container swiper-container">
                <div class="swiper-wrapper">
                    @if($products && count($products) > 0)
                        @foreach($products as $product)
                            <div class="swiper-slide">
                                <div class="one-product-container">
                                    <div class="thumbnail one-product-div">
                                        <div class="one-product-img">
                                            <img src="{{ $product['image'] }}" class="full-width">
                                        </div>
                                        <div class="caption">
                                            <a class="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}"><b>{{$product['name']}}</b></a>
                                            <p class="product-price">{{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}} {{__('_store_home.sr')}}
                                               @if(Helpers::getProductDataItemFromGroup($product, 'extra', 'price')!=Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price') && Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price') > Helpers::getProductDataItemFromGroup($product, 'extra', 'price') && Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price')!=0 )
                                                <strike class="pull-right">{{Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price')}} {{__('_store_home.sr')}}</strike>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="overlay thumbnail">
                                        <a href="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}" class="btn btn-outline-custom btn-white first-btn col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">{{__('_store_home.details')}}</a>
                                        <a href="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}" class="btn btn-outline-custom btn-white col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1" data-id="{{$product['id']}}">{{__('_store_home.add_to_cart')}}</a>
                                        <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 no-padding">
                                            <a href="#" class="btn btn-outline-custom btn-white col-xs-6 add_to_wish_list" data-id="{{$product['id']}}"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="btn btn-outline-custom btn-white col-xs-6 compare-product" data-id="{{$product['id']}}"><i class="fa fa-exchange"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{__('_store_home.no_most_selling')}}
                    @endif
                </div>
            </div>
        </div>




    </div>

    <div class="clearfix"></div>
    <hr>
    <div class="col-md-4 col-sm-12 col-xs-12">
        {{-- events --}}
        {{-- <div class="events-section events-page">
            <div class="home-section home-events-section">
                <h4 class="uppercase main-title">
                    <a href="{{ url('events') }}">{{__('_site_home.new_events')}}</a>
                    <span class="pull-right"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                </h4>

                @foreach($events as $event)
                    <div class="col-md-12 col-sm-6">
                        <div class="event-div half-height" style="background-image:url('{{ $event['image'] }}')">
                            <div class="date"><span class="year">{{ $event['created_year'] }}</span><span class="day">{{ $event['created_day'] }}</span><br/><span class="month">{{ $event['created_month'] }}</span></div>
                            <div class="name">
                                <a href="{{ url("event-details/{$event['id']}/".Helpers::str2url($event['name'])) }}">{{ $event['name'] }}</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                    </div>
                @endforeach
                <div class="clearfix"></div>
            </div>
        </div> --}}
        {{-- end events --}}

        {{-- about us --}}
        <div class="events-section events-page">
            <div class="home-section home-events-section">
                <h4 class="uppercase main-title">
                    <a href="#">{{__('_site_home.about_us')}}</a>
                    <span class="pull-right"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                </h4>
                <p>
                    {{ $about['description'] }}
                </p>
                @foreach($about['media'] as $media)
                    <div class="col-md-2 col-sm-6 col-xs-12  no-padding">
                        @if($media['type'] == "Video")
                            @if(strlen($media['link']))
                                <a href="{{ $media['link'] }}" item-type="video" item-video-id="{{ (Helpers::getYoutubeVideoId($media['link'])) }}" class="gal-item">
                                <i class="fa fa-play-circle-o"></i>
                                <img src="{{ $media['image'] }}"
                                     class="full-width centered-and-cropped"/>
                                </a>
                            @endif
                        @else
                            <a href="{{ $media['image'] }}" item-type="image" class="gal-item">
                                <img src="{{ $media['image'] }}" class="full-width centered-and-cropped"/>
                            </a>
                        @endif
                    </div>
                @endforeach
                <div class="clearfix"></div>
            </div>
        </div>
        {{-- end about us --}}
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12 facebook-feed">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fm.facebook.com%2FArabiaTanks-288328128387982%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12 twitter-feed">
        <a class="twitter-timeline" href="https://twitter.com/Arabia_Tanks?ref_src=twsrc%5Etfw">Tweets by ArabiaWS</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>    </div>
        
</div>
    </div>
@endsection