@extends('template')

@section('title', "Account Settings")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('account-settings') }}

            <div class="account-div">

                @include('partials._userProfileSidebar')

                <div class="bordred-account-div col-md-9 col-sm-7 col-xs-12">
                    <form class="bordered col-xs-12" method="post">

                        <h3 class="uppercase">
                            {{__('_user_account_settings.settings')}}
                        </h3>

                        @include('partials._formMessages')


                        <div class="form-group  float-label-control">
                            <label for="name">{{__('_user_account_settings.full_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name')!=""?old('name'):Session::get('name')  }}">
                        </div>
                        {{csrf_field()}}
                        <div class="form-group  float-label-control">
                            <label for="brithdate">{{__('_user_account_settings.birthdate')}}</label>
                            <!-- <input type="date" class="form-control" id="brithdate"> -->
{{--                            {{ old('birthDate')!=""?old('birthDate'):date('Y-m-d', Session::get('birth_date'))  }}--}}
                            {{--{{ old('birth_date')!=null?old('birthdate'):(\Session::get('birthdate')!=null)?date('Y-m-d', \Session::get('birth_date')):'' }}--}}
                            <input type="date" id="date" class="form-control floating-label" name="birthdate" value="{{ old('birthDate')!=null?old('birthDate'):(\Session::get('birth_date')!=null?date('Y-m-d', Session::get('birth_date')):'')  }}">
                        </div>
                        <div class="form-group">
                            <label for="country">{{__('_user_account_settings.country')}}</label>
                            <select class="form-control" id="country" name="country_id">
                                @foreach($countries as $country)
                                    <option value="{{$country['id']}}"
                                            @if(Session::get('country_id') == $country['id'])
                                                selected
                                            @endif
                                            >{{$country['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="district">{{__('_user_account_settings.region')}}</label>
                            <select class="form-control" name="region_id" id="region_id">
                                @foreach($regions as $region)
                                    <option value="{{$region['id']}}"
                                            @if(Session::get('region_id') == $region['id'])
                                                selected
                                            @endif
                                            >{{$region['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">{{__('_user_account_settings.city')}}</label>
                            <select class="form-control" id="city_id" name="city_id">
                                @foreach($cities as $city)
                                    @if($city['id'] == Session::get('city_id'))
                                        <option selected value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  float-label-control">
                            <label for="mobile">{{__('_user_account_settings.mobile')}}</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile" value="{{ old('mobile')!=""?old('mobile'):Session::get('mobile')  }}">
                        </div>
                        <div class="form-group  float-label-control">
                            <label for="email">{{__('_user_account_settings.email')}}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email')!=""?old('email'):Session::get('email')  }}">
                        </div>
                        <div class="form-group">
                            <label for="subscribe" class="lbl-for-toggle">{{__('_user_account_settings.subscribe')}}</label>
                            <label class="switch pull-right">
                                <input name="subscribe" id="newsletter-subscribe" type="checkbox"
                                        @if(\Session::get('is_subscribed') != null && \Session::get('is_subscribed') == 1)
                                            checked
                                        @endif
                                        >
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <button type="submit" class="btn form-submit-btn btn-outline-custom  btn-blue col-xs-12 no-padding uppercase">{{__('_user_account_settings.save')}}</button>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <button type="button" onclick="location.assign('{{route('user-orders')}}')" class="btn form-submit-btn col-xs-12 no-padding uppercase cancel-btn">{{__('_user_account_settings.cancel')}}</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 col-md-offset-3 col-xs-10 col-md-offset-1 gap-top">
                        <p class="text-center"><a href="{{ route('change-password') }}">{{__('_user_account_settings.change_pass')}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('bottom_scripts')
    <script>
        $('#region_id').on('change', function()
        {
           $.ajax({
            type: 'get',
            url: "{{ route('get-region-cities') }}",
            data: {region_id: $(this).val()},
            success: function(response)
            {
                response = JSON.parse(response);
                // console.log(response.content.length);
                if(response.content.length > 0)
                {
                    $('#city_id').html('');

                    for(var i = 0; i < response.content.length; i++)
                    {
                        var id   = response.content[i].id;
                        var name = response.content[i].name;

                        var option = '<option value="'+id+'">'+name+'</option>';

                        $('#city_id').append(option);
                    }
                }
            }
           }); 
        });
//        var subscribe_checkbox = $('#newsletter-subscribe');
//
//        $(document).ready(function()
//        {
//            subscribe_checkbox.change(function()
//            {
//                switch($(this).is(':checked'))
//                {
//                    case true:
//                        break;
//                    case false:
//                        break;
//                }
//            });
//        });

//        document.getElementById("district").selectedIndex = -1;
//        document.getElementById("country").selectedIndex = -1;
//        document.getElementById("city").selectedIndex = -1;
    </script>
@endsection