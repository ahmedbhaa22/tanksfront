@extends('template')

@section('title', "Login")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">


            <div class="container">
                <h3 class="main-title uppercase text-center">
                    {{__('_user_orders.payment_receipt')}}
                </h3>
                <div class="clear-fix"></div>

                @include('partials._formMessages')

                <form method="post" action="{{ action('UserController@addPurchaseProve') }}"class="bordered col-md-6 col-md-offset-3 col-xs-10 col-md-offset-1" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group float-label-control">

                        <div class="clear-fix"></div>
                        <input name="payment_receipt" type="file" class="form-control" required>
                    </div>
                    <input type="hidden" name="order_id" value="<?php echo $order_id?>" />
                    <div class="col-md-6 col-md-offset-3 col-xs-10 col-md-offset-1">
                        <input type="submit" value="Save">
                    </div>
                  </form>

            </div>
        </div>
    </div>

@endsection