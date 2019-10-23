@extends('template')

@section('title', "Edit Shipping Address")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container product-details-page">


            <div class="container account-div">

                @include('partials._userProfileSidebar')

                <div class="bordred-account-div col-md-9 col-sm-7 col-xs-12">
                    <form class="bordered col-xs-12" method="POST">

                        {{ method_field('PUT') }}

                        {{csrf_field()}}

                        <h3 class="uppercase">
                            {{__('_user_edit_address.edit_address')}}
                        </h3>

                        @include('partials._formMessages')

                        <div class="form-group">
                            <label for="country">{{__('_user_edit_address.country')}}</label>
                            <select class="form-control" id="country_id" name="country_id">
                                @foreach($countries as $country)
                                    <option value="{{$country['id']}}"
                                            @if($country['id'] == $address['country_id'])
                                                selected
                                            @endif
                                            >{{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">{{__('_user_edit_address.city')}}</label>
                            <select class="form-control" id="city" name="city_id">
                                @foreach($cities as $city)
                                    <option value="{{$city['id']}}"
                                            @if($city['id'] == $address['city_id'])
                                                selected
                                            @endif
                                            >{{$city['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">{{__('_user_edit_address.region')}}</label>
                            <select class="form-control" id="state" name="region_id">
                                @foreach($regions as $region)
                                    <option value="{{$region['id']}}"
                                            @if($region['id'] == $address['region_id'])
                                                selected
                                            @endif
                                            >{{$region['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group float-label-control">
                            <label for="address1">{{__('_user_edit_address.addr_details')}}</label>
                            <input type="text" class="form-control" id="address1" name="details" value="{{ old('details')!=''?old('details'):$address['details']}}">
                        </div>
                        <div class="form-group float-label-control">
                            <label for="zip">{{__('_user_edit_address.postal')}}</label>
                            <input type="text" class="form-control" id="zip" name="postal_code" value="{{old('postal_code')!=''?old('postal_code'):$address['postal_code']}}">
                        </div>
                        <div class="form-group">
                            <label for="" class="lbl-for-toggle">{{__('_user_edit_address.main')}}</label>
                            <label class="switch pull-right">
                                <input type="checkbox" name="is_main" {{$address['is_main']==1?"checked":""}}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <button type="submit" class="btn form-submit-btn btn-outline-custom  btn-blue col-xs-12 no-padding uppercase">{{__('_user_edit_address.save')}}</button>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <button type="button" onclick="location.assign('{{url("shipping-addresses")}}');" class="btn form-submit-btn col-xs-12 no-padding uppercase cancel-btn">{{__('_user_edit_address.cancel')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection