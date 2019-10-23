@extends('template')

@section('title', "Store | Offers | " . $offer['name'])

@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <div class="container-fluid no-padding page-body">
    <div class="container">

        {{ Breadcrumbs::render('offer-details', $offer) }}

        @include('partials._topCategories', ['categories' => $categories])

        @if($tags)
        <div class="col-xs-12">

                @foreach($tags as $value)
                    <a href="#"><span class="label label-default">{{$value['name']}}</span></a>
                @endforeach

        </div>
        @endif

        <div class="col-md-8 col-sm-9 no-padding">
            <div class="offer-div full-height" style="background-image:url({{ $offer['image'] }})">

            </div>
        </div>

        <div class="col-md-4 col-sm-3 no-padding product-details-col pro-middle-col">
            <h4 class="product-title uppercase col-md-7 no-padding">
               {{$offer['name']}}
            </h4>

            <div class="col-md-5 no-padding">

                <a class="btn offers-btn small-btn btn-block-blue pull-right no-padding add_to_wish_list" data-id="{{$offer['id']}}" href="#" title="Add to wishlist">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                </a>
                <div class="fb-share-button pull-right" data-href="{{route('offer-details', ['id' => $offer['id'], 'slug' => str_slug($offer['name'])])}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('offer-details', ['id' => $offer['id'], 'slug' => str_slug($offer['name'])])}}&amp;src=sdkpreparse">{{__('_store_offer_details.share')}}</a></div>

            </div>

            <div class="col-md-12 no-padding">{{$offer['description']}}</div>

            <div class="clearfix"></div>

            <div class="col-xs-12 gap no-padding">
                <div class="form-group ">
                    <label for="deliver-place ">{{__('_store_offer_details.delivery_place')}}</label>
                    <select class="form-control bordered" name="deliver-place" id="deliver-place">
                        @if(!empty($deliveryPlaces))
                            @foreach($deliveryPlaces as $item)
                                <option value="{{$item[0]['value']}}">{{$item[1]['value']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="clearfix "></div>
            <div class="price-container ">
                <p class="product-tag tag-flash-sale"> <i class="fa fa-star"></i>{{__('_store_offer_details.best_price')}}</p>
                <p class="price">
                    {{--<span class="pre-reduction">{{ $originalPrice }} {{__('_store_offer_details.sr')}}</span>--}}
                    <span class="current-price"><strong>{{__('_store_offer_details.now')}} </strong><strong>{{ $newPrice }} {{__('_store_offer_details.sr')}}</strong></span>

                    @if($originalPrice && $newPrice)
                        {{--<span class="discount">{{__('_store_offer_details.save')}}<strong> {{ $originalPrice - $newPrice }}</strong><span>{{__('_store_offer_details.sr')}}</span><span> ({{ $discountPercent }}%)</span></span>--}}
                    @endif
                </p>
            </div>
            <div class="clearfix"></div>
            <button type="button" class="btn add-to-cart gap-left" data-id="{{$offer['id']}}"><i class="fa fa-shopping-bag"></i>{{__('_store_offer_details.add_to_cart')}}</button>

            <b class="expire-date pull-right" style="direction: ltr">
            @if(in_array(1, $offerTypesIds) && in_array(2, $offerTypesIds))
                {{date('d/m/Y', $offerEndDate)}}{{__('_store_offer_details.offer_to_date_or_qty')}}
            @elseif(in_array(1, $offerTypesIds) && !in_array(2, $offerTypesIds))
                    {{__('_store_offer_details.offer_to_qty')}}
            @elseif(!in_array(1, $offerTypesIds) && in_array(2, $offerTypesIds))
                {{date('d/m/Y', $offerEndDate)}}{{__('_store_offer_details.offer_to_date')}}
            @endif
</b>

        </div>
        <div class="clearfix"></div>

        <div class="row">
            <h3 class="col-xs-12">{{__('_store_offer_details.offer_products')}}</h3>

            @if($products)
                @foreach($products as $product)
                    <div class="col-sm-6 col-xs-6 no-padding">
                        <div class="bordred-div not-curved clearfix shopping-cart-div">
                            <div class="col-sm-3 col-xs-12 product-list-img-div no-padding">
                                <div class="product-list-img" style="background-image:url({{ $product['image'] }})"></div>
                            </div>
                            <div class="col-sm-9 col-xs-12 product-details">
                                <b class="uppercase">{{ $product['name'] }}</b><br/>
                                <span><span class="pram-title">{{__('_store_offer_details.qty')}}</span> 3</span><br/>
                                <span><span class="pram-title">{{__('_store_offer_details.color')}}</span> {{ Helpers::getProductKeyValueItemText($product, 'avaliable_colors_entity', true) }} </span><br/>
                                <span><span class="pram-title">{{__('_store_offer_details.total_price')}}</span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="clearfix"></div>
            <div class="col-sm-12 ">
                <button type="button" class="btn add-to-cart" data-id="{{$offer['id']}}"><i class="fa fa-shopping-bag"></i>{{__('_store_offer_details.add_to_cart')}}</button>
            </div>

        </div>
    </div>
</div>

    @include('partials._modals')
@endsection

@section('bottom_scripts')
    {!! Html::script('public/js/functions.js') !!}

    <script>
        $(document).ready(function() {
            $(".add-to-cart").on("click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var item = $(this);
                add_to_cart(item.attr('data-id'), 2, 1, $("#deliver-place").val(), '{{csrf_token()}}');
            });

            $(".add_to_wish_list").on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                var item = $(this);
                add_to_wish_List(item.attr('data-id'), 2, '{{csrf_token()}}');

                return false;
            });
        });
    </script>
@endsection