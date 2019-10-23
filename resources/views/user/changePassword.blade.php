@extends('template')

@section('title', "Change Password")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('change-password') }}

            <div class="account-div">

                @include('partials._userProfileSidebar')

                <div class="bordred-account-div col-md-9 col-sm-7 col-xs-12">
                    <form class="bordered col-xs-12" method="post">
                        {{csrf_field()}}
                        <h3 class="uppercase">
                            {{__('_user_change_password.change_password')}}
                        </h3>

                        @include('partials._formMessages')

                        <div class="form-group float-label-control">
                            <label for="old-password">{{__('_user_change_password.old')}}</label>
                            <input type="password" class="form-control" id="old-password" name="password" value="{{old('password')}}">
                        </div>
                        <div class="form-group float-label-control">
                            <label for="new-password">{{__('_user_change_password.new')}}</label>
                            <input type="password" class="form-control" id="new-password" name="new_password" value="{{old('new_password')}}">
                        </div>
                        <div class="form-group float-label-control">
                            <label for="confirm-password">{{__('_user_change_password.re-new')}}</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm_password" value="{{old('confirm_password')}}">
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <button type="submit" class="btn form-submit-btn btn-outline-custom  btn-blue col-xs-12 no-padding uppercase">{{__('_user_change_password.save')}}</button>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <button type="button" onclick="location.assign('{{url("user-orders")}}')" class="btn form-submit-btn col-xs-12 no-padding uppercase cancel-btn">{{__('_user_change_password.cancel')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection