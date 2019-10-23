@extends('template')

@section('title', "Store | Shopping Cart")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container product-details-page">

            {{ Breadcrumbs::render('shopping-cart') }}

            <div class="container">
                <h3 class="main-title uppercase">
                    عربة التسوق
                </h3>

                <!-- Show Products -->
                @if($products)
                    @foreach($products as $key => $product)
                        <div class="bordred-div not-curved clearfix shopping-cart-div" id="shopping-cart-div-{{$key}}">
                            <div class="col-sm-2 col-xs-6 products-list-img-div no-padding">
                                <div class="products-list-img full-width" style="background-image:url({{ $product['image'] }});"></div>
                            </div>
                            <div class="col-sm-6 col-xs-6 product-details">
                                <b class="uppercase"> <a href="{{url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name']))}}"> {{$product['name']}}</a> </b>
                                @if(Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')!='')
                                    <span class="text-danger"> ( {{Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')}} خصم ) </span>
                                @endif

                                <br/>
                                <span><span class="pram-title">السعر : </span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}}</span><br/>
                                <span><span class="pram-title">المصنع : </span> العربية</span><br/>
                                <span><span class="pram-title">الكمية : </span> </span>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <p class="text-primary pull-right"><span>اجمالي السعر : </span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}}</p>
                                <div class="clearfix"></div>
                                <a href="javascript:void(0)" class="btn btn-danger clear-product btn-md pull-right remove-from-cart" data-id="{{$product['id']}}" title="remove"><i class="fa fa-trash"></i></a>
                                <a href="#" class="btn btn-primary add-to-cart btn-md pull-right" title="compare"><i class="fa fa-exchange"></i></a>
                            </div>
                        </div>
                    @endforeach


                    <div class="bordred-div not-curved clearfix">
                        <form class="bordered">
                            <div class="col-xs-12 form-group  float-label-control">
                                <label for="coupon">كود الكوبون</label>
                                <input type="text" class="form-control" id="coupon">
                            </div>
                            <div class="">
                                <a href="#" class="btn btn-outline-custom pull-right btn-blue col-xs-3"> تاكيد</a>
                            </div>
                        </form>
                    </div>
                    <div class="bordred-div not-curved clearfix">
                        <div class="row">
                            <div class="col-xs-6 ">
                                <b>حاصل الجمع</b>
                            </div>
                            <div class="col-xs-6">
                                <span class="pull-right">{{$extraData['price']}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 ">
                                <b>خصم (15%)</b>
                            </div>
                            <div class="col-xs-6">
                                <span class="pull-right">{{$extraData['discount_amount']}}</span>
                            </div>
                        </div>
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-6 ">--}}
                                {{--<b>كوبون</b>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-6">--}}
                                {{--<span class="pull-right">0 جم</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <hr/>
                        <div class="row">
                            <div class="col-xs-6 ">
                                <b>الاجمالى</b>
                            </div>
                            <div class="col-xs-6">
                                <span class="pull-right">{{$extraData['total_price']}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <a href="#" class="btn form-submit-btn  btn-block-blue col-xs-12 no-padding"><i class="fa fa-shopping-bag"></i> تاكيد</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('partials._modals')
@endsection

@section('bottom_scripts')
    {!! Html::script('public/js/functions.js') !!}

    <script>
        $(document).ready(function() {
            $(".remove-from-cart").on("click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var item = $(this);
                // if product type 1 else 2
                remove_from_cart(item.attr('data-id'), 1, '{{csrf_token()}}');
                item.parents(".shopping-cart-div").remove();
            });
        });
    </script>
@endsection