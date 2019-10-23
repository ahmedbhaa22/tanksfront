@extends('template')

@section('title', "Confirm Registeration")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            <h3 class="main-title uppercase text-center">
                {{__('_user_confirm_register.confirm_register')}}
            </h3>

            <div class="container">
                @if($return['status'] == 0)
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{$return['message']}}</strong>
                        @if(isset($return['summary']))
                            <ul>
                                @foreach($return['summary'] as $sm)
                                    <li>{{$sm}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @elseif($return['status'] == 1)
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <h3 class="main-title text-center">{{$return['message']}}</h3>
                    </div>
                @endif
                    <a href="{{url('login')}}">{{__('_user_confirm_register.back_to_home')}}</a>
            </div>
        </div>
    </div>

@endsection