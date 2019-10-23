@extends('template')

@section('title', "Store | Shopping Cart | Checkout")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container product-details-page">

            {{ Breadcrumbs::render('shopping-cart') }}

            @include('partials._formMessages')

            <div class="container">
                @if($products)
                    <form method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div id="smartwizard">
                            <ul>
                                <li><a href="#step-1">1<br /><small>{{__('_store_shopping_cart.shopping_cart')}}</small></a></li>
                                <li><a href="#step-2">2<br /><small>{{__('_store_shopping_cart.shipping_info')}}</small></a></li>
                                <li><a href="#step-3">3<br /><small>{{__('_store_shopping_cart.payment_methods')}}</small></a></li>
                                <li><a href="#step-4">4<br /><small>{{__('_store_shopping_cart.attach_receipt')}}</small></a></li>
                            </ul>
                            <div>
                                <div id="step-1" class="">

                                    <h3 class="main-title uppercase">
                                        {{__('_store_shopping_cart.shopping_cart')}}
                                    </h3>

                                        @php
                                         $cart_final_price = 0;
                                         $all_products_prices = 0;
                                         $all_tax_amount = 0;
                                         $total_after_tax = 0;
                                        @endphp



                                        @foreach($products as $key => $product)

                                            <div class="col-md-6">
                                                <div class="bordred-div not-curved clearfix shopping-cart-div" id="shopping-cart-div-{{$key}}">
                                                    <div class="col-sm-2 col-xs-6 products-list-img-div no-padding">
                                                        <div class="products-list-img full-width" style="background-image:url('{{$product['image']}}');"></div>
                                                    </div>
                                                    <div class="col-sm-6 col-xs-6 product-details">
                                                        <b class="uppercase">{{$product['name']}}</b>
                                                        @if(Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')!='')
                                                            <span class="text-danger"> ( {{Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')}} ({{__('_store_shopping_cart.discount')}}</span><br/>
                                                        @endif
                                                        <span class="col-xs-12 no-padding"><span class="pram-title">{{__('_store_shopping_cart.price')}}</span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}}</span><br/>
                                                        <span class="col-xs-12 no-padding"><span class="pram-title">{{__('_store_shopping_cart.tax')}}</span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'tax_percent')}}</span><br/>
                                                        <span class="col-xs-12 no-padding"><span class="pram-title">{{__('_store_shopping_cart.factory')}}</span> {{Helpers::getManufacturer($product)}}</span><br/>
                                                        <span class="col-xs-12 no-padding"><span class="pram-title">{{__('_store_shopping_cart.qty')}}</span>{{Helpers::getCount($product)}}</span>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <p class="text-primary pull-right"><span>{{__('_store_shopping_cart.total_price')}}</span>
                                                            @php
                                                                $all_products_prices += Helpers::getProductDataItemFromGroup($product, 'extra', 'price');
                                                                $price_total = Helpers::getProductDataItemFromGroup($product, 'extra', 'price');
                                                                $all_tax_amount += $price_total  + Helpers::getProductDataItemFromGroup($product, 'extra', 'tax_percent');
                                                                // $price_total = $price_total + ($price_total * (Helpers::getProductDataItemFromGroup($product, 'extra', 'tax_percent') / 100));

                                                                if(Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')!='')
                                                                    {
                                                                $price_total = $price_total - ($price_total * (Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent') / 100));
                                                                }
                                                            @endphp
                                                         {{$price_total * Helpers::getCount($product)}}</p>

                                                        <div class="clearfix"></div>
                                                        <a href="javascript:void(0)" class="btn btn-danger clear-product btn-md pull-right remove-from-cart" data-id="{{$product['id']}}" data-item-id="{{Helpers::getItemType($product)}}" title="remove"><i class="fa fa-trash"></i></a>
                                                        <a href="#" class="btn btn-primary add-to-cart btn-md pull-right compare-product" data-id="{{$product['id']}}" title="compare"><i class="fa fa-exchange"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @php
                                            $total_after_tax = $all_products_prices + $all_tax_amount;
                                        @endphp


                                    <div class="clearfix"></div>
                                    <div class="col-xs-12">
                                        {{-- copoun --}}
                                        {{-- <div class="bordred-div not-curved clearfix">
                                            <form class="bordered">
                                                <div class="col-xs-12 form-group no-padding float-label-control">
                                                    <label for="coupon">{{__('_store_shopping_cart.coupon_code')}}</label>
                                                    <span class="error-line text-danger">{{__('_store_shopping_cart.no_coupon')}}</span>
                                                    <input type="text" class="form-control" id="coupon">
                                                </div>
                                                <div class="">
                                                    <a href="#" class="btn btn-outline-custom pull-right btn-blue col-xs-3">{{__('_store_shopping_cart.confirm')}}</a>
                                                </div>
                                            </form>
                                        </div> --}}
                                        {{-- end copoun --}}

                                        <div class="bordred-div not-curved clearfix">
                                            <div class="bordred-div not-curved clearfix">
                                                <div class="row">
                                                    <div class="col-xs-6 ">
                                                        <b>{{__('_store_shopping_cart.sum')}}</b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right">{{$extraData['price']}}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 ">
                                                        <b>{{__('_store_shopping_cart.all_tax')}}</b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right">{{$extraData['tax_amount']}}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6 ">
                                                        <b>{{__('_store_shopping_cart.discount')}}</b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right">{{$extraData['discount_amount']}}</span>
                                                    </div>
                                                </div>
                                                {{-- copouns --}}
                                                {{-- <div class="row">
                                                    <div class="col-xs-6 ">
                                                        <b>{{__('_store_shopping_cart.coupons')}}</b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right">{{__('_store_shopping_cart.sr')}} 0</span>
                                                    </div>
                                                </div> --}}
                                                {{-- end copouns --}}
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-xs-6 ">
                                                        <b>{{__('_store_shopping_cart.total')}}</b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right">{{$extraData['total_price']}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         

                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div id="step-2" class="">

                                    <div class="col-md-8">
                                        <h4 class="main-title uppercase col-xs-12 ">{{__('_store_shopping_cart.shipping_addresses')}}</h4>
                                        <div class="clearfix"></div>

                                        @if($extraData['user_address'])
                                            <div class="bordred-div not-curved clearfix addresses-list">
                                                <div class="col-sm-1 col-xs-2">
                                                    <input type="checkbox" id="check1" name="shippingAddress" value="{{$extraData['user_address']['id']}}" checked disabled>
                                                    <label for="check1"></label>
                                                </div>
                                                <div class="col-sm-3 col-xs-10">
                                                    <b class="uppercase">{{$extraData['user_address']['details']}}</b>
                                                </div>
                                                <div class="col-sm-8 col-xs-12">
                                                    <span>{{$extraData['user_address']['details']}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6  col-xs-10 pull-right">
                                                <a href="{{route('shipping-addresses')}}" target="_blank" class="btn form-submit-btn btn-outline-custom  btn-blue  col-xs-12 no-padding">{{__('_store_shopping_cart.change_address')}}</a>
                                            </div>
                                        @endif

                                        <h4 class="main-title uppercase col-xs-12">{{__('_store_shopping_cart.leave_comment')}}</h4>
                                        <div class="clearfix"></div>

                                        <div class="clearfix">
                                            <div class="col-xs-12 form-group  float-label-control">
                                                <label for="info">{{__('_store_shopping_cart.shipping_time_info')}}</label>
                                                <input type="text" class="form-control" id="info" name="userComment">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="main-title uppercase gap-left">{{__('_store_shopping_cart.order_details')}}</h4>
                                        @foreach($products as $key => $product)
                                            <div class="col-xs-12 no-padding">
                                                <div class="bordred-div not-curved clearfix shopping-cart-div">
                                                    <div class="col-sm-3 col-xs-12 product-list-img-div no-padding">
                                                        <div class="product-list-img" style="background-image:url('{{$product['image']}}');"></div>
                                                    </div>
                                                    <div class="col-sm-9 col-xs-12 product-details">
                                                        <b class="uppercase">{{$product['name']}}</b><br/>
                                                        <span class="col-xs-12 no-padding"><span class="pram-title">{{__('_store_shopping_cart.qty')}}</span> 3</span><br/>
                                                        <span class="col-xs-12 no-padding"><span class="pram-title">{{__('_store_shopping_cart.color')}}</span> {{ Helpers::getProductKeyValueItemText($product, 'avaliable_colors_entity', true) }}</span><br/>
                                                        <span class="col-xs-12 no-padding"><span class="pram-title">{{__('_store_shopping_cart.total_price')}}</span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}}</span><br/>
                                                        <span class="col-xs-12 no-padding"><span class="pram-title">{{__('_store_shopping_cart.tax')}}</span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'tax_percent')}}&nbsp%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-xs-12 no-padding">
                                            <div class="bordred-div not-curved clearfix">
                                                <div class="row">
                                                    <div class="col-xs-6 ">
                                                        <b>{{__('_store_shopping_cart.sum')}}</b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right">{{$extraData['price']}}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-xs-6 ">
                                                    <b>{{__('_store_shopping_cart.all_tax')}}</b>
                                                </div>
                                                <div class="col-xs-6">
                                                    <span class="pull-right">{{$extraData['tax_amount']}}</span>
                                                </div>
                                            </div>
                                                <div class="row">
                                                    <div class="col-xs-6 ">
                                                        <b>{{__('_store_shopping_cart.discount')}}</b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right">{{$extraData['discount_amount']}}</span>
                                                    </div>
                                                </div>
                                                {{-- copouns --}}
                                                {{-- <div class="row">
                                                    <div class="col-xs-6 ">
                                                        <b>{{__('_store_shopping_cart.coupons')}}</b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right">{{__('_store_shopping_cart.sr')}} 0</span>
                                                    </div>
                                                </div> --}}
                                                {{-- end copouns --}}
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-xs-6 ">
                                                        <b>{{__('_store_shopping_cart.total')}}</b>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right">{{$extraData['total_price']}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div id="step-3" class="">

                                    <h4 class="main-title uppercase col-xs-12 ">{{__('_store_shopping_cart.payment_method')}}</h4>
                                    <div class="clearfix"></div>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ا{{__('_store_shopping_cart.bank_name')}}</th>
                                            <th>{{__('_store_shopping_cart.IBAN_no')}}</th>
                                            <th>{{__('_store_shopping_cart.acc_name')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if($extraData['payment_methods'])
                                                @foreach($extraData['payment_methods'] as $method)
                                                    <tr>
                                                        <td>{{$method['bank_name']}}</td>
                                                        <td>{{$method['account_number']}}</td>
                                                        <td>{{$method['account_name']}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <p>{{__('_store_shopping_cart.please_attach')}}</p>
                                    <div class="clearfix"></div>
                                </div>

                                <div id="step-4" class="">
                                    <h4 class="main-title uppercase col-xs-12 ">{{__('_store_shopping_cart.attach_receipt')}}</h4>
                                    <p>{{__('_store_shopping_cart.please_attach')}}</p>
                                    <div class="clearfix"></div>
                                    <br/>
                                    <div class="col-xs-4 no-padding">
                                        <div class="">
                                            <label for="pic-upload" class="custom-file-upload text-center uppercase">
                                                {{__('_store_shopping_cart.upload')}}
                                            </label>
                                            <input id="pic-upload" name="payment_receipt" type="file">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                    </form>
                @else
                    <h3>{{__('_store_shopping_cart.no_products')}}</h3>
                @endif
            </div>
        </div>
        @include('partials._modals')
@endsection

@section('bottom_scripts')
            {!! Html::script('public/js/functions.js') !!}

            <script>
                var next_text = "{{__('_store_shopping_cart.next_text')}}";
                var prev_text = "{{__('_store_shopping_cart.prev_text')}}";
                $(document).ready(function() {
                    $(".remove-from-cart").click(function(e){
                        e.preventDefault();
                        e.stopPropagation();
                        var item = $(this);
                        // if product type 1 else 2
                        remove_from_cart(item.attr('data-id'), item.attr('data-item-id'), '{{csrf_token()}}');
                        item.parents(".shopping-cart-div").remove();
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


            <script>
                $(document).ready(function(){

                    // Smart Wizard events
                    $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {

                    });

                    // This event should initialize before initializing smartWizard
                    // Otherwise this event wont load on first page load
                    $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
                        $("#message-box").append(" > <strong>showStep</strong> called on " + stepNumber + ". Direction: " + stepDirection+ ". Position: " + stepPosition);
                    });

                    $("#smartwizard").on("beginReset", function(e) {
                        $("#message-box").append("<br /> > <strong>beginReset</strong> called");
                    });

                    $("#smartwizard").on("endReset", function(e) {
                        $("#message-box").append(" > <strong>endReset</strong> called");
                    });

                    $("#smartwizard").on("themeChanged", function(e, theme) {
                        $("#message-box").append("<br /> > <strong>themeChanged</strong> called. New theme: " + theme);
                    });

                    // Toolbar extra buttons
                    var btnFinish = $('<button type="submit"></button>').text('{{__('_store_shopping_cart.complete_text')}}')
                            .addClass('btn btn-info btn-md btn-finish')
                            .on('click', function(){  });
                    // var btnCancel = $('<button type="button"></button>').text('الغاء')
                    //         .addClass('btn btn-danger btn-md btn-cancel')
                    //         .on('click', function(){ $('#smartwizard').smartWizard("reset"); });
                    var btnCancel = $('<a href="{{ route("home") }}" style="color:white;"></a>').text('{{__('_store_shopping_cart.cancel_text')}}')
                            .addClass('btn btn-danger btn-md btn-cancel');

                    // Smart Wizard initialize
                    $('#smartwizard').smartWizard({
                        selected: 0,
                        theme: 'dots',
                        transitionEffect:'fade',
                        lang: {  // Language variables
                            next: next_text,
                            previous: prev_text
                        },
                        toolbarSettings: {toolbarPosition: 'bottom',
//                            enableFinishButton: true,
                            toolbarExtraButtons: [btnFinish, btnCancel]
                        },
                        onShowStep: function (objs, context) {
                            $(".btn-cancel, .btn-finish").hide();
                        },
                        onFinish: function (objs, context) {
                            $(".btn-finish").show();
                        }
                    });

                    // External Button Events
                    $("#reset-btn").on("click", function() {
                        // Reset wizard
                        $('#smartwizard').smartWizard("reset");
                        return true;
                    });

                    $("#prev-btn").on("click", function() {
                        // Navigate previous
                        $('#smartwizard').smartWizard("prev");
                        return true;
                    });

                    $("#next-btn").on("click", function() {
                        // Navigate next
                        $('#smartwizard').smartWizard("next");
                        return true;
                    });

                    $("#theme_selector").on("change", function() {
                        // Change theme
                        $('#smartwizard').smartWizard("theme", $(this).val());
                        return true;
                    });

                });

            </script>


@endsection