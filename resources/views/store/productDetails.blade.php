@extends('template')

@section('title', "Store | Shopping Center | " . $product['name'])

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


        {{ Breadcrumbs::render('product-details', $product) }}

        @include('partials._topCategories', ['categories' => $categories])

        @if($productData['tags'])
            <div class="col-xs-12" style="margin-right: 15px;margin-bottom: 5px;">

                @foreach($productData['tags'] as $value)
                    <a href="#"><span class="label label-success">{{$value['name']}}</span></a>
                @endforeach

            </div>
        @endif

       <br/>

        <div class="col-md-5">
            @include('partials._productMedia', ['product' => $product])
        </div>

        <div class="col-md-4 col-sm-6  no-padding product-details-col pro-middle-col">
            <h4 class="product-title uppercase col-md-7 no-padding">
                {{$product['name']}}
            </h4>
            <div class="col-md-5 no-padding">
                <a data-id="{{$product['id']}}" id="compare-it" class="btn offers-btn small-btn btn-block-blue pull-right" title="Compare">
                    <i class="fa fa-exchange" aria-hidden="true  pull-right"></i>
                </a>
                <a class="btn offers-btn small-btn btn-block-blue pull-right no-padding add_to_wish_list_btn" data-id="{{$product['id']}}" title="Add to wishlist">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                </a>
            </div>
            <div class="clearfix"></div>
            <p>{{  $product['description'] }}</p>
            <span class="stars" data-rating="1" data-num-stars="5"></span>
            <div class="clearfix"></div>
            <h4>{{__('_store_product_details.product_details')}}</h4>
            <ul class="gap15">
                <li><b>{{__('_store_product_details.factory')}}</b>{{Helpers::getManufacturer($product)}}</li>
                <li><b class="pull-left">{{__('_store_product_details.color')}}</b>
                    <select id="color-select">
                        <optgroup>
                            @if($productData['colors'])
                                @foreach($productData['colors'] as $item)
                                    <option value="{{$item['hex_code']}}">{{$item['value_title']}}</option>
                                @endforeach
                            @endif
                        </optgroup>
                    </select>
                </li>
            </ul>
            <div class="col-xs-12 no-padding">
                <div class="form-group">
                    <label for="deliver-place">{{__('_store_product_details.delivery_place')}}</label>
                    <select class="form-control bordered" name="deliver-place" id="deliver-place">
                        @if(!empty($branches))
                            @foreach($branches as $branch)
                                <option value="{{$branch['id']}}">{{$branch['name']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 no-padding gap15">
                <div class="input-group">
						<span class="input-group-btn">
															<button type="button" class="btn btn-default btn-number" id="decrement-counter" disabled="disabled" data-type="minus" data-field="quant[1]">
																	<span class="glyphicon glyphicon-minus"></span>
						</button>
						</span>
                    <input type="text" name="quant[1]" class="form-control input-number quantity-input" id="quantity-input" value="1" min="{{$productData['CartMin']}}" max="{{$productData['CartMax']}}" style="border: 1px solid #c2cad8;">
						<span class="input-group-btn">
															<button type="button" class="btn btn-default btn-number" id="increment-counter" data-type="plus" data-field="quant[1]">
																	<span class="glyphicon glyphicon-plus"></span>
						</button>
						</span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="price-container">
                <p class="product-tag tag-flash-sale"> <i class="fa fa-star"></i>{{__('_store_product_details.best_price')}}</p>
                <p class="price">
                    @php
                        $price = $productData['newPrice'];
                        $old_price = $productData['oldPrice'];
                    @endphp

                    @if($price == $old_price)
                        @if($productData['newPrice'] != '')
                        <span class="current-price"><strong>{{$productData['newPrice']}} {{__('_store_product_details.sr')}}</strong></span>
                        @endif
                    @else
                        @if($productData['oldPrice'] != '')
                        <span class="pre-reduction">{{ $productData['oldPrice'] }} {{__('_store_product_details.sr')}}</span>
                        @endif

                        @if($productData['newPrice'] != '')
                            <span class="current-price"><strong>{{__('_store_product_details.now')}}</strong>&nbsp<strong>{{$productData['newPrice']}} {{__('_store_product_details.sr')}}</strong></span>
                        @endif
                    @endif

                    @if($productData['discountPercent'] != '')
                        <span class="discount">{{__('_store_product_details.save')}}<strong>{{$productData['oldPrice']-$productData['newPrice']}}</strong><span>{{__('_store_product_details.sr')}}</span><span> ({{$productData['discountPercent']}})</span></span>
                    @endif
                </p>
                <p>
                    &nbsp{{__('_store_product_details.added_value_tax_not_included')}}
                </p>
            </div>
            <div class="clearfix"></div>
            <br/>

        </div>
        <div class="col-md-3 col-sm-6 pro-col">
            <div class="info-module">
                <div class="share">
                    <div class="fb-share-button" data-href="{{route('product-details', ['id' => $product['id'], 'slug' => str_slug($product['name'])])}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('product-details', ['id' => $product['id'], 'slug' => str_slug($product['name'])])}}&amp;src=sdkpreparse">{{__('_store_product_details.share')}}</a></div>
                </div>
                @if($productData['deliveryDate'] != '')
                    <hr>
                    <h5><i class="fa fa-truck"></i>&nbsp{{__('_store_product_details.fast_delivery')}}</h5>
                    <div class="content-holder">
                        <p class="delivery-estimate">{{ $productData['deliveryDate'] }} </p>
                    </div>
                @endif
            </div>
            <hr/>
            @if($productData['importantNotes'] != '')
                <div class="info-module">
                    <h5><i class="fa fa-hand-paper-o"></i>{{__('_store_product_details.we_promise')}}</h5>
                    <div class="content-holder">
                        <ul class="wadi-promises">
                            <li>{{ $productData['importantNotes'] }} </li>
                        </ul>
                    </div>
                </div>
                <hr/>
            @endif

            @if($productData['inWarranty'][0]['value_id']==5)
                <div class="info-module">
                    <h5><i class="fa fa-thumbs-up"></i>&nbsp{{__('_store_product_details.guarantee')}}</h5>
                    <div class="content-holder">
                        <p>{{ $productData['warrantyPeriod'] }} </p>
                        @if($productData['otherWarranty'])
                            <p>{{ $productData['otherWarranty'] }} </p>
                        @endif
                    </div>
                </div>
            @endif
            {{--</span>--}}
        </div>
        <div class="clearfix"></div>
        <div class="">
            <button type="button" class="btn add-to-cart add-to-cart-btn pull-right gap-left" data-id="{{$product['id']}}"><i class="fa fa-shopping-bag"></i>{{__('_store_product_details.add_to_cart')}}</button>
        </div>
        <ul class="nav nav-tabs nav-justified products-tabs">
            <li class="active"><a data-toggle="tab" href="#overview">{{__('_store_product_details.product_description')}}</a></li>
            <li><a data-toggle="tab" href="#specification">{{__('_store_product_details.specifications')}}</a></li>
            <li><a data-toggle="tab" href="#rate">{{__('_store_product_details.comments')}}</a></li>
        </ul>
        <div class="tab-content products-tab-content">
            <div id="overview" class="tab-pane fade in active col-xs-12">
                <p>
                    {!! html_entity_decode($product['content']) !!}
                </p>
            </div>
            <div id="specification" class="tab-pane fade  col-xs-12">
                <table class="table table-striped">
                    <tbody>
                        @foreach($productData['productAttrs'] as $key => $val)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$val}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="rate" class="tab-pane fade  col-xs-12">
                <a class="btn offers-btn btn-outline-custom btn-blue pull-right no-padding" href="" data-toggle="modal" data-target="#ratingModal">
                    <i class="fa fa-plus" aria-hidden="true"></i>{{__('_store_product_details.add_comment')}}
                </a>
                <div class="clearfix"></div>
                @if(count($reviews))
                    @foreach($reviews as $review)
                        <div class="bordred-div clearfix">
                            <div class="col-md-2 col-sm-3 col-xs-12"><img class="full-width" src="{{ asset($review['product_image']) }}" /></div>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <b class="col-md-12 no-padding">{{$review['user_name']}}</b>
                                <div>
                                    <span class="stars" data-rating="{{$review['rating']}}" data-num-stars="5"></span>
                                </div>
                                <div class="clearfix"></div>
                                {{$review['review']}}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    @endforeach
                @endif
            </div>
            <hr/>
            <h4 class="main-title uppercase  col-md-10 no-padding">
                {{__('_store_product_details.related_products')}}
            </h4>

            <div class="category-two-swiper-container swiper-container">
                <div class="swiper-wrapper">

                    @if($relatedProducts)
                        @foreach($relatedProducts as $product)
                            <div class="swiper-slide">
                                <div class="one-product-container col-xs-12 no-padding">
                                    <div class="thumbnail one-product-div">
                                        <div class="one-product-img">
                                            <img src="{{ $product['image'] }}" class="full-width">
                                        </div>
                                        <div class="caption">
                                            <a class="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}"><b> {{$product['name']}}</b></a>
                                            <p class="product-price">{{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}} {{__('_store_product_details.sr')}}
                                                @if(Helpers::getProductDataItemFromGroup($product, 'extra', 'price')!=Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price') && Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price') > Helpers::getProductDataItemFromGroup($product, 'extra', 'price') && Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price')!=0 )

                                                <strike class="pull-right">{{Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price')}} {{__('_store_product_details.sr')}}</strike>
                                            @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="overlay thumbnail">
                                        <a href="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}" class="btn btn-outline-custom btn-white first-btn col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">{{__('_store_product_details.details')}}</a>
                                        <a href="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}" class="btn btn-outline-custom btn-white col-md-8 col-md-offset-2" data-id="{{$product['id']}}">{{__('_store_product_details.add_to_cart')}}</a>
                                        <div class="col-md-8 col-md-offset-2 no-padding">
                                            <a href="#" class="btn btn-outline-custom btn-white col-md-6 add_to_wish_list" data-id="{{$product['id']}}"><i class="fa fa-heart-o"></i></a>
                                            <a href="#" class="btn btn-outline-custom btn-white col-md-6"><i class="fa fa-exchange"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

    @include('partials._modals')

@endsection

@section('bottom_scripts')

    <script>
        document.getElementById("deliver-place").selectedIndex = -1;
    </script>



    <script language="javascript" type="text/javascript">
        $('#color-select').colorSelect();
    </script>


    <script>
        $.fn.stars = function () {
            return $(this).each(function () {
                var rating = $(this).data("rating");
                var numStars = $(this).data("numStars");
                var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');
                var halfStar = ((rating % 1) !== 0) ? '<i class="fa fa-star-half-empty"></i>' : '';
                var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');
                $(this).html(fullStar + halfStar + noStar);
            });
        }
        $('.stars').stars();
    </script>


    <script>
        var swiper = undefined;
        function initSwiper() {
            var screenWidth = $(window).width();
            if (screenWidth > 992) {
                var swiper = new Swiper('.category-two-swiper-container', {
                    slidesPerView: 5,
                    spaceBetween: 15,
                    autoplay: 5000,
                });

            }
            else if (screenWidth < 992 && screenWidth > 481) {

                var swiper = new Swiper('.category-two-swiper-container', {
                    pagination: '.category-two-swiper-pagination',
                    slidesPerView: 3,
                    paginationClickable: true,
                    spaceBetween: 30,
                    autoplay: 5000,
                });

            }
            else if (screenWidth < 480) {

                var swiper = new Swiper('.category-two-swiper-container', {
                    pagination: '.category-two-swiper-pagination',
                    slidesPerView: 1,
                    paginationClickable: true,
                    spaceBetween: 30,
                    autoplay: 5000,
                });

            }
        }
        initSwiper();
        $(window).on('resize', function () {
            initSwiper();
        });
    </script>

    {!! Html::script('public/js/functions.js') !!}

    <script>
        function submitUserReview(token, rating, user_comment, product_id) {
            $.ajax({
                type: 'post',
                url: base_url + '/store/submitUserReview',
                data: {
                    _token: token,
                    rating: rating,
                    user_comment: user_comment,
                    product_id: product_id
                },
                success: function (response) {
                    if(response.status === 1)
                    {
                        window.location.href = base_url + '/store/product-details/' + product_id + '/' + product_id;
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }

            var add_to_cart = (function(item_id, item_type, count, delivery_place, csrf_token) {
            var html = '';
            $.ajax({
                url: base_url+"/store/add-to-cart",
                data: {_token: csrf_token, item_id: item_id, item_type: item_type, delivery_place: delivery_place, count: count},
                type: "POST",
                dataType: "json",
                headers: {token: csrf_token},
                success: function (res) {
                    // var json = $.parseJSON(res);
                    var json = res;
                    if(json['status'] == 0) {
                        html += '<h3>'+json['message']+'</h3>';
                        html += '<div class="alert alert-danger alert-dismissable"><ul>';
                        if(json['errors']) {
                            $.each(json['errors'], function (i, t) {
                                html += '<li>' + t + '</li>';
                            });
                        }
                        html += '</ul></div>';
                    }else if(json['status'] == 1) {
                        html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
                        window.location.href = base_url + '/store/product-details/'+item_id+'/'+item_id
                    }
                    $("#addToCartModal").find(".modal-body").html(html);
                    $("#addToCartModal").modal("show");
                },
                error: function () {
                    console.log("ajax error!");
                }
            });
        });

        var add_to_wish_List = (function(item_id, item_type, csrf_token) {
            var html = '';
            $.ajax({
                url: base_url+"/store/add-to-wish-list",
                data: {_token: csrf_token, item_id: item_id, item_type: item_type},
                type: "POST",
                dataType: "json",
                headers: {token: csrf_token},
                success: function (res) {
                    // var json = $.parseJSON(res);
                    var json = res;
                    if(json['status'] == 0) {
                        html += '<h3>'+json['message']+'</h3>';
                        html += '<div class="alert alert-danger alert-dismissable"><ul>';
                        if(json['errors']) {
                            $.each(json['errors'], function (i, t) {
                                html += '<li>' + t + '</li>';
                            });
                        }
                        html += '</ul></div>';
                    }else if(json['status'] == 1) {
                        html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
                        window.location.href = base_url + '/store/product-details/' + item_id +'/' + item_id;
                    }
                    $("#addToWishListModal").find(".modal-body").html(html);
                    $("#addToWishListModal").modal("show");
                },
                error: function () {
                    console.log("ajax error!");
                }
            });
        });

        var compare_product = (function(item_id, csrf_token) {
            var html = '';
            $.ajax({
                url: base_url+"/store/post-compare-product",
                data: {_token: csrf_token, item_id: item_id},
                type: "POST",
                dataType: "json",
                headers: {token: csrf_token},
                success: function (res) {
                    // var json = $.parseJSON(res);
                    var json = res;
                    if(json['status'] == 0) {
                        html += '<h3>'+json['message']+'</h3>';
                        html += '<div class="alert alert-danger alert-dismissable"><ul>';
                        if(json['errors']) {
                            $.each(json['errors'], function (i, t) {
                                html += '<li>' + t + '</li>';
                            });
                        }
                        html += '</ul></div>';
                    }else if(json['status'] == 1) {
                        html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
                        window.location.href = base_url + '/store/product-details/' + item_id +'/' + item_id;
                    }
                    $("#compareModal").find(".modal-body").html(html);
                    $("#compareModal").modal("show");
                },
                error: function () {
                    console.log("ajax error!");
                }
            });
        });

        $(document).ready(function() {

            // submit review
            var submit_review_btn = $('#submit-review-btn');
            var star_rating_select = 0;

            $('.start-rating').click(function()
            {
                star_rating_select = $(this).val();
            });

            submit_review_btn.click(function()
            {
                var star_rating  = star_rating_select;
                var user_comment = $('#comment');

                if(user_comment.val().length && star_rating)
                {
                    $('#err-span').hide();
                    submitUserReview('{{csrf_token()}}', star_rating, user_comment.val(), '{{ $product['id'] }}');
                }
                else
                {
                    $('#err-span').show();
                    user_comment.focus();
                    return false;
                }
            });

            // main product actions
            $(".add-to-cart-btn").on("click", function(e){
                e.preventDefault();
                e.stopPropagation();

                var item = $(this);
                add_to_cart(item.attr('data-id'), 1, $("#quantity-input").val(), $("#deliver-place").val(),  '{{csrf_token()}}');
            });

            $(".add_to_wish_list_btn").on("click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var item = $(this);
                add_to_wish_List(item.attr('data-id'), 1, '{{csrf_token()}}');
            });

            $(".add_to_wish_list").on("click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var item = $(this);
                add_to_wish_List(item.attr('data-id'), 1, '{{csrf_token()}}');
            });

            $("#compare-it").click(function()
            {
                var item = $(this);
                compare_product(item.data('id'), "{{csrf_token()}}");
            });

            var counter = $("#quantity-input").val();
            $("#increment-counter").click(function() {
                if(counter <= $("#quantity-input").attr("max")) {
                    $("#quantity-input").val(counter++);
                } else {
                    $("#increment-counter").prop("disabled", true);
                    $("#decrement-counter").removeAttr("disabled");
                }
            });

            $("#decrement-counter").click(function() {
                if(counter >= $("#quantity-input").attr("min")) {
                    $("#quantity-input").val(counter--);
                } else {
                    $("#decrement-counter").prop("disabled", true);
                    $("#increment-counter").removeAttr("disabled");
                }
            });
        });
    </script>

@endsection