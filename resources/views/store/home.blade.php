@extends('template')

@section('title', "Store")

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container product-details-page">

        {{ Breadcrumbs::render('store') }}

        @include('partials._topCategories', ['categories' => $categories])

        <div class="row">
            <!-- Load offers and ads block -->
            @include('partials._offerAds', ['offers' => $offers, 'ads' => $ads])
        </div>
        <div class="clearfix"></div>

        <div class="clearfix"></div>

        <div>
            <div class="col-xs-12 gap">
                <div id="products-wrapper">
                    @if($products_all)
                        @foreach($products_all as $product)
                            <div class="col-lg-3 col-md-4 col-xs-6" >
                                <div class="col-xs-12 no-padding product-list-img-div">
                                    <div class="one-product-container">
                                        <div class="thumbnail one-product-div">
                                            <img src="{{$product['image']}}" class="full-width">
                                            @if(Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')!='')
                                                <span class="product-offer-bar">
                                                            <p> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')}}</p>
                                                    </span>
                                            @endif
                                            <div class="caption">
                                                <a class="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}"><b>{{$product['name']}}</b></a>
                                                @php
                                                    $price = Helpers::getProductDataItemFromGroup($product, 'extra', 'price');
                                                    $old_price = Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price');
                                                @endphp

                                                @if($price == $old_price || $old_price==0 || $old_price=="")
                                                    <p class="product-price">{{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}} {{__('_store_shopping_center.sr')}}
                                                    </p>
                                                @else
                                                    <p class="product-price">{{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}} {{__('_store_shopping_center.sr')}}
                                                        <strike class="pull-right">{{Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price')}} {{__('_store_shopping_center.sr')}}</strike>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="overlay thumbnail col-xs-12">
                                            <a href="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}" class="btn btn-outline-custom btn-white first-btn col-xs-8 col-xs-offset-2">{{__('_store_shopping_center.details')}}</a>
                                            <a href="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}" class="btn btn-outline-custom btn-white col-xs-8 col-xs-offset-2" data-id="{{$product['id']}}">{{__('_store_shopping_center.add_to_cart')}}</a>
                                            <div class="col-xs-8 col-xs-offset-2 no-padding">
                                                <a href="#" class="btn btn-outline-custom btn-white col-xs-6 add_to_wish_list" data-id="{{$product['id']}}"><i class="fa fa-heart-o"></i></a>
                                                <a href="#" class="btn btn-outline-custom btn-white col-xs-6 compare-product" data-id="{{$product['id']}}"><i class="fa fa-exchange"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>


        <div class="clearfix"></div>
        <hr/>
        {{-- manufacturers --}}
        {{-- <div class="categories-div">
            <div class="col-xs-12 gap clearfix">
                <div class="main-title">
                    <h4 class="pull-left uppercase no-padding">
                        {{__('_store_home.manufacturers')}}
                    </h4>
                    <a href="{{ url('store/manufactures') }}" class="pull-right">{{__('_store_home.all_manufacts')}}</a>
                </div>
            </div>

            <div class="col-xs-12 gap">
                <div class="brands swiper-container">
                    <div class="swiper-wrapper">
                        @if($manufacturers)
                            @foreach($manufacturers as $manfacturer)
                                <a href="{{ url('store/shopping-center?filterManf[]='.$manfacturer['id']) }}" class="swiper-slide brand-one">
                                    <div class="brand-img">
                                        <img src="{{ $manfacturer['image'] }}" alt="{{ $manfacturer['name'] }}">
                                    </div>
                                    <div class="brand-desc">
                                        <h2> {{ $manfacturer['name'] }}</h2>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div> --}}
        {{-- end manufacturers --}}
        <div class="clearfix"></div>
    </div>
</div>
    @include('partials._modals')
@endsection

@section('bottom_scripts')
    {!! Html::script('public/js/functions.js') !!}
    <script>
        $(document).ready(function() {
            $(".add_to_wish_list").on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                var item = $(this);
                add_to_wish_List(item.attr('data-id'), 1, '{{csrf_token()}}');

                return false;
            });

            $(".compare-product").on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                var item = $(this);
                compare_product(item.attr('data-id'), '{{csrf_token()}}');
                return false;
            });
        });
    </script>
@endsection