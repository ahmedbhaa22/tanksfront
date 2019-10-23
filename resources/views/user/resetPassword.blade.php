@extends('template')

@section('title', "Reset Password")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('reset-password') }}

            <div class="container">
                <h3 class="main-title uppercase text-center">
                    {{__('_user_reset_password.reset')}}
                </h3>

                @include('partials._formMessages')

                <form method="post" class="bordered col-md-6 col-md-offset-3 col-xs-10 col-md-offset-1">
                    {{csrf_field()}}
                    <div class="form-group  float-label-control">
                        <label>{{__('_user_reset_password.password')}}</label>
                        <input type="password" class="form-control" name="password" value="">
                    </div>
                    <div class="form-group  float-label-control">
                        <label>{{__('_user_reset_password.confirm_password')}}</label>
                        <input type="password" class="form-control" name="confirm_password" value="">
                    </div>
                    <button type="submit" class="btn form-submit-btn btn-outline-custom btn-blue col-xs-12">{{__('_user_reset_password.reset_send')}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection