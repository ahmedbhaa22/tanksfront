@extends('template')

@section('title', "Store | Wish List")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('wish-list') }}

            <div class="container">
                <h3 class="main-title uppercase">
                    {{__('_store_wishlist.wishlist')}}
                </h3>

                <!-- Show Products -->
                @if($products)
                    @foreach($products as $key => $product)
                        <div class="bordred-div not-curved clearfix wish-list" id="wish-list-{{$key}}">
                            <div class="col-md-2 col-sm-4 col-xs-6 product-list-img"
                                 style="background-image:url({{ $product['image'] }})"></div>
                            <div class="col-md-5 col-sm-4 col-xs-6 ">
                                <b class="uppercase">{{$product['name']}}</b><br/>
                                @if(Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')!='')
                                    <span><span class="pram-title">{{__('_store_wishlist.discount_percent')}}</span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')}}</span><br/>
                                @endif
                                <span><span class="pram-title">{{__('_store_wishlist.price')}}</span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}}</span><br/>
                                <span><span class="pram-title">{{__('_store_wishlist.factory')}}</span> {{Helpers::getManufacturer($product)}}</span>
                            </div>
                            <div class="col-md-5 col-sm-4 col-xs-12">
                                <a href="#" class="btn btn-danger clear-product  btn-md pull-right" title="remove"
                                   onclick="document.getElementById('wish-list-{{$key}}').style.display = 'none'"><i
                                            class="fa fa-trash"></i></a>
                                <a href="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}" class="btn btn-success add-to-cart btn-md pull-right"
                                   title="add to cart" data-id="{{$product['id']}}"><i class="fa fa-shopping-bag"></i></a>
                                <a href="#" class="btn btn-primary btn-md pull-right compare-product" data-id="{{$product['id']}}" title="compare"><i
                                            class="fa fa-exchange"></i></a>
                            </div>
                        </div>
                    @endforeach

                <div class="col-xs-4 col-xs-offset-4">
                    <a href="#" class="btn form-submit-btn btn-outline-custom  btn-blue col-xs-12 no-padding"><i
                                class="fa fa-trash"></i>{{__('_store_wishlist.remove_wishlist')}}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('partials._modals')
@endsection

@section('bottom_scripts')

    <script>
        document.getElementById("district").selectedIndex = -1;
        document.getElementById("country").selectedIndex = -1;
        document.getElementById("city").selectedIndex = -1;
    </script>

    {!! Html::script('public/js/functions.js') !!}
    <script>
        $(document).ready(function() {
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