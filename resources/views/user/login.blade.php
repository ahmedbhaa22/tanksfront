@extends('template')

@section('title', "Login")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('login') }}

            <div class="container">
                <h3 class="main-title uppercase text-center">
                    {{__('_user_login.login')}}
                </h3>

                @include('partials._formMessages')

                <form method="post" class="bordered col-md-6 col-md-offset-3 col-xs-10 col-md-offset-1">
                    {{ csrf_field() }}
                    <div class="form-group float-label-control">
                        <label for="">{{__('_user_login.email')}}</label>
                        <input name="email" type="text" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="form-group float-label-control">
                        <label for="password">{{__('_user_login.password')}}</label>
                        <input name="password" type="password" class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn form-submit-btn btn-outline-custom btn-blue uppercase col-xs-12">{{__('_user_login.login')}}</button>
                </form>
                <div class="col-md-6 col-md-offset-3 col-xs-10 col-md-offset-1">
                    <p class="col-md-6"><a href="{{url('register')}}">{{__('_user_login.no_account')}}</a> </p>
                    <p class="col-md-6"><a href="{{url('check-email')}}" class="pull-right">{{__('_user_login.forgot')}}</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection