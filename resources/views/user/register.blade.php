@extends('template')

@section('title', "Register")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('register') }}

            <div class="container">
                <h3 class="main-title uppercase text-center">
                    {{__('_user_register.register')}}
                </h3>

                @include('partials._formMessages')

                <form method="post" class="bordered  col-md-8 col-md-offset-2 col-xs-10 col-md-offset-1">
                    {{csrf_field()}}
                    <div class="form-group  float-label-control">
                        <label for="email">{{__('_user_register.email')}}</label>
                        <span class="error-line text-danger">{{__('_user_register.required')}}</span>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group  float-label-control">
                        <label for="username">{{__('_user_register.username')}}</label>
                        <span class="error-line text-danger">{{__('_user_register.required')}}</span>
                        <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">
                    </div>
                    <div class="form-group  float-label-control">
                        <label for="password">{{__('_user_register.password')}}</label>
                        <span class="error-line text-danger">{{__('_user_register.required')}}</span>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="false">
                    </div>
                    <div class="form-group  float-label-control">
                        <label for="confirm-password">{{__('_user_register.re-pass')}}</label>
                        <span class="error-line text-danger">{{__('_user_register.required')}}</span>
                        <input type="password" class="form-control" name="confirmPassword" id="confirm-password" autocomplete="false" >
                    </div>
                    <div class="form-group  float-label-control">
                        <label for="name">{{__('_user_register.name')}}</label>
                        <span class="error-line text-danger">{{__('_user_register.required')}}</span>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group  float-label-control">
                        <label for="mobile">{{__('_user_register.mobile')}}</label>
                        <span class="error-line text-danger">{{__('_user_register.required')}}</span>
                        <input type="tel" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}">
                    </div>
                    <button type="submit" class="btn form-submit-btn btn-outline-custom btn-blue col-xs-12">{{__('_user_register.save')}}</button>
                </form>
                <div class="col-md-6 col-md-offset-3 col-xs-10 col-md-offset-1">
                    <p class="text-center">{{__('_user_register.have_account')}}<a href="{{url('login')}}">{{__('_user_register.login')}}</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('bottom_scripts')
    <script>
//        document.getElementById("district").selectedIndex = -1;
//        document.getElementById("country").selectedIndex = -1;
//        document.getElementById("city").selectedIndex = -1;

        $(".form-control").keyup(function () {
            if($(this).val() != '') {
                $(this).siblings(".error-line").hide();
            } else {
                $(this).siblings(".error-line").show();
            }
        });
    </script>
@endsection