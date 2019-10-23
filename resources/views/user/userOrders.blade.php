@extends('template')

@section('title', "User Orders")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('user-orders') }}

            <div class="container account-div">

                @include('partials._userProfileSidebar')

                <div class="bordred-account-div col-md-9 col-sm-7 col-xs-12">
                    <div class="col-xs-12 no-padding">

                        <h3 class=" uppercase">
                            {{__('_user_orders.orders')}}
                        </h3>

                        @if($orders)
                            @foreach($orders as $order)
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                <div class="col-md-6"><p><b>{{__('_user_orders.order_no')}}</b>{{$order['id']}}</p></div>
                                <div class="col-md-6"><p class="pull-right"><span class="label label-primary"> {{$order['status_name']}} </span></p>
                                </div>
                                <div class="col-md-6"><p><b>{{__('_user_orders.total_price')}}</b>{{$order['total_price']}}</p></div>
                                <div class="col-md-6 ">
                                    <!-- <label for="pic-upload" class="custom2-file-upload text-info bold">
                                    ارفع صورة ايصال الايداع <i class="fa fa-cloud-upload "></i>
                                </label>
                                    <input id="pic-upload" type="file"> -->
                                    <p class="pull-right"><b> <i class="fa fa-calendar"></i> &nbsp; </b> {{date('m/d/Y', $order['date'])}}</p>
                                </div>

                                <div class="clearfix"></div>
                                       <div class="row">
                                           <a href="{{ url('purchase-prove/'.$order['id']) }}">{{__('_user_orders.add_purchase_prove')}}</a>
                                           {{--<a href="#">{{__('_user_orders.view_purchase_prove')}}</a>--}}
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

@endsection