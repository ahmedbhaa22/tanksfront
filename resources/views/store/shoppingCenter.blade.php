@extends('template')

@section('title', "Store | Shopping Center")

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container product-details-page">

        {{ Breadcrumbs::render('shopping-center') }}

        <div class="container">
            <h3 class="main-title uppercase">
                {{__('_store_shopping_center.shopping_center')}}
            </h3>

            <!-- Include Filter sidebar -->
            @include('partials._productsFilterSidebar', ['manufacturersList' => $manufacturersList,
            'categoriesList' => $categoriesList, 'allCategoriesProductCount' => $allCategoriesProductCount])

            <div class="col-md-9  col-sm-8 no-padding">
                <div class="col-xs-12 gap15 no-padding">
                    <div class="col-sm-5 no-padding">
                        {{$totalProducts}} {{__('_store_shopping_center.result')}}
                        {{--<label class="label label-warning sm-lbl">مصنع 1<a class="no-border"> <i class="fa fa-times"></i></a></label>--}}
                    </div>
                    <div  class="col-sm-7 no-padding xs-margin-top">
                        <div class="pull-right gap-left">
                            <a href="{{$links["listLink"]}}" class="btn btn-md {{$displayMode=='list'?'add-to-cart':''}}" title="view list"><i class="fa fa-list-ul"></i></a>
                        </div>
                        <div class="pull-right ">
                            <a href="{{$links["gridLink"]}}" class="btn btn-md {{$displayMode=='grid'?'add-to-cart':''}}" title="view grid"><i class="fa fa-th"></i></a>
                        </div>
                        <form method="GET">
                            <div class="dropdown  col-sm-4 col-xs-5 pull-right">
                                <button class="btn  dropdown-toggle " type="button" data-toggle="dropdown"> <i class="fa fa-sort"></i> {{($sortField=='name'?__('_store_shopping_center.by_name'):($sortField=='price'?__('_store_shopping_center.by_price'):__('_store_shopping_center.sort')))}}
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{$links["sortPrice"]}}">{{__('_store_shopping_center.by_price')}}</a></li>
                                        <li><a href="{{$links["sortName"]}}">{{__('_store_shopping_center.by_name')}}</a></li>
                                    </ul>
                            </div>
                            <div class="dropdown  col-sm-3 col-xs-3 pull-right">
                                <button class="btn  dropdown-toggle " type="button" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-sort"></i>{{($sortType=='asc'?__('_store_shopping_center.asc'):($sortType=='desc'?__('_store_shopping_center.desc'):__('_store_shopping_center.sort_type')))}}
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{$links["sortAsc"]}}">{{__('_store_shopping_center.asc')}}</a></li>
                                        <li><a href="{{$links["sortDesc"]}}">{{__('_store_shopping_center.desc')}}</a></li>
                                    </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div id="products-wrapper">
                @if($displayMode == 'grid')
                    @if($products)
                        @foreach($products as $product)
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
                @else
                    @if($products)
                        @foreach($products as $product)
                            <div class="bordred-div not-curved clearfix" id="item1">
                                <a href="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}">
                                    <div class="col-md-2 col-sm-4 col-xs-12 order-img" style="background-image:url('{{$product['image']}}');"></div>
                                </a>
                                <div class="col-md-10 col-sm-8 col-xs-12">
                                    <div class="col-sm-6 col-xs-12 no-padding">
                                        <a href="{{ url('store/product-details/'.$product['id'].'/'.Helpers::str2url($product['name'])) }}">
                                            <b class="uppercase">{{$product['name']}}</b>
                                        </a>
                                        <br/>
                                        @if(Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')!='')
                                            <span><span class="pram-title">{{__('_store_shopping_center.discount_percent')}}</span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent')}}</span><br/>
                                        @endif
                                            <span><span class="pram-title">{{__('_store_shopping_center.price')}}</span> {{Helpers::getProductDataItemFromGroup($product, 'extra', 'price')}}</span>
                                    </div>
                                    <div class="col-sm-6 col-xs-12  no-padding pull-left">
                                        <span><span class="pram-title">{{__('_store_shopping_center.factory')}}</span> {{Helpers::getManufacturer($product)}}</span><br/>
                                        <span><span class="pram-title"><i class="fa fa-map-marker"></i></span> {{implode(", ", Helpers::getBrancheNames($product))}}</span><br/>
                                        <span><span class="pram-title"><i class="fa fa-calendar"></i></span> {{date('d/m/Y', $product['created_at'])}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
                </div>
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

            // if select first checkbox in categories then check all
            $("input#c0").click(function(e){
                if($(this).is(":checked")) {
                    $(".sub-categories").prop("checked", true);
                } else {
                    $(".sub-categories").prop("checked", false);
                }
            });
        });
    </script>

<script>
    (function($) {
        var $window = $(window),
                $filter = $('#filter-sec');

        $window.resize(function resize() {
            if ($window.width() > 750) {
                return $filter.addClass('in');
//                console.log("lessthan100");
            }
            $filter.removeClass('in');
        }).trigger('resize');
    })(jQuery);


</script>

<script>
    function getQueryParams(){
        try{
            url = window.location.href;
            query_str = url.substr(url.indexOf('?')+1, url.length-1);
            r_params = query_str.split('&');
            params = {}
            for( i in r_params){
                param = r_params[i].split('=');
                params[ param[0] ] = param[1];
            }
            return params;
        }
        catch(e){
            return {};
        }
    }
    function addOrUpdateUrlParam(uri, paramKey, paramVal) {
        var re = new RegExp("([?&])" + paramKey + "=[^&#]*", "i");
        if (re.test(uri)) {
            uri = uri.replace(re, '$1' + paramKey + "=" + paramVal);
        } else {
            var separator = /\?/.test(uri) ? "&" : "?";
            uri = uri + separator + paramKey + "=" + paramVal;
        }
        return uri;
    }
    $(function (e) {
        $("input.filter-category, input.filter-manufacturer").click(function (e) {
            $("#filter-form").submit();
        });
    });

//    $("input.filter-category, input.filter-manufacturer").click(function (e) {
//        //$("#filter-form").submit();
//        var elem = $(this);
//        var attrName = elem.attr("name");
//        var attrVal = elem.val();
//        var CurrentUrl = window.location.href;
//
//        if(elem.is(":checked")) {
//            if (history.pushState) {
//                var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
//                if(/[?&]/.test(window.location.search)) {
//
//                    var QueryStr = CurrentUrl.substr(CurrentUrl.indexOf('?')+1, CurrentUrl.length-1);
//
//                    //newurl += "?"+query_str+"&"+$(this).attr("name")+"="+$(this).val();
//
//                    var ExistingQueryParams = getQueryParams();
//                    if(!(attrName in ExistingQueryParams)) {
//                        newurl += "?"+QueryStr+"&"+attrName+"="+attrVal;
//////                        $.each(getQueryParams(), function (name, val) {
//////                            if (name != $(this).attr("name"))
//////                                    });
//                    } else {
//                        newurl += "?"+QueryStr;
//                    }
//                } else {
//                    newurl += "?"+attrName+"="+attrVal;
//                }
//                window.history.pushState({path:newurl},'',newurl);
//            }
//        }
//    });
</script>

@endsection
