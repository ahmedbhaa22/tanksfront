@extends('template')

@section('title', "Shipping Addresses")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container product-details-page">

            {{ Breadcrumbs::render('shipping-addresses') }}

            <div class="container account-div">

                @include('partials._userProfileSidebar')

                <div class="bordred-account-div col-md-9 col-sm-7 col-xs-12">
                    <div class=" col-xs-12">

                        <h3 class="uppercase">
                            {{__('_user_shipping_addresses.shipping_addresses')}}
                        </h3>

                        @include('partials._messages')
                        <div id="st_msg"></div>

                        <form action="#">
                            @foreach($addresses as $key => $address)
                                <div class="bordred-div not-curved clearfix addresses-list" id="item{{$key}}">
                                    <div class="col-md-1 col-xs-2">
                                        <input type="radio" id="radio{{$key}}" data-id="{{$address['id']}}" class="radio-btn" name="radio-group"
                                                @if($address['is_main'] == 1)
                                                    checked
                                                @endif
                                                />
                                        <label for="radio{{$key}}"></label>
                                    </div>
                                    <div class="col-md-3 col-xs-10">
                                        <b class="uppercase">{{$address['details']}}<span class="text-primary col-xs-12 no-padding">{{$address['is_main']==1?__('_user_shipping_addresses.main'):""}}<span></b>
                                    </div>
                                    <div class="col-md-3 col-xs-12 col-md-push-5">
                                        @if($address['is_main'] != 1)
                                            <a href="#" class="btn btn-danger clear-product clear-shipping btn-xs pull-right" data-id="{{$address['id']}}"><i class="fa fa-trash"></i></a>
                                        @endif
                                            <a href="{{url('edit-shipping-address/'.$address['id'])}}" class="btn add-to-cart btn-xs pull-right"><i class="fa fa-pencil"></i></a>
                                    </div>
                                    <div class="col-md-5 col-xs-12 col-md-pull-3" style="right: -5% !important;width: inherit;">
                                        <span>{{$address['details']}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                        <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                            <a href="{{url('add-shipping-address')}}" class="btn form-submit-btn btn-block-blue col-xs-12 no-padding">{{__('_user_shipping_addresses.new_address')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('bottom_scripts')
    {!! Html::script('public/js/functions.js') !!}

    <script>
        var set_main_shipping_address = (function (item_id, csrf_token) {
            var html = '';
            $("#st_msg").html("");

            return $.ajax({
                url: base_url+"/set-main-shipping-address",
                data: {_token: csrf_token, item_id: item_id},
                type: "POST",
                dataType: "json",
                headers: {token: csrf_token}
                //success: function (res) {
                //    // var json = $.parseJSON(res);
                //    var json = res;
                //    if(json['status'] == 0) {
                //        html += '<h3>'+json['message']+'</h3>';
                //        html += '<div class="alert alert-danger alert-dismissable"><ul>';
                //        if(json['errors']) {
                //            $.each(json['errors'], function (i, t) {
                //                html += '<li>' + t + '</li>';
                //            });
                //        }
                //        html += '</ul></div>';
                //    }else if(json['status'] == 1) {
                //        window.location.href = base_url+'/shipping-addresses';
                //        html += '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>'+json['message']+'</span></div>';
                //    }
                //    $("#st_msg").html(html);
                //},
                //error: function () {
                //    console.log("ajax error!");
                //}
            });
        });

        $(function () {
            $(".clear-shipping").click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                var item = $(this);
                var conf = confirm("Are you sure?");
                if(conf) {
                    delete_shipping_address(item.attr("data-id"), '{{csrf_token()}}');
                }
            });

            $(".radio-btn").click(function () {
                var item = $(this);
                if($(this).is(":checked")) {
                    $.when(set_main_shipping_address(item.data("id"), '{{csrf_token()}}')).done(function(response)
                    {
                        if(response.status === 1)
                        {
                            setTimeout(function()
                            {
                                window.location.assign("{{route('shipping-addresses')}}");
                            }, 2000);
                        }
                    });
                    {{--set_main_shipping_address(item.attr("data-id"), '{{csrf_token()}}');--}}
                }
            });
        })
    </script>
@endsection