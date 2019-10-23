@extends('template')

@section('title', "Contact Us")

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container">

        {{ Breadcrumbs::render('contact-us') }}

        <div class="col-xs-12 no-padding">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                <h4 class="main-title uppercase  text-center">
                    {{__('_site_contact.send')}}
                </h4>

                @include('partials._formMessages')

                <form class="bordered" method="post">
                    {{csrf_field()}}
                    <div class="form-group float-label-control">
                        <label for="name">{{__('_site_contact.name')}}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    </div>
                    <div class="form-group float-label-control">
                        <label for="email">{{__('_site_contact.email')}}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group float-label-control">
                        <label for="issue">{{__('_site_contact.inq')}}</label>
                        <textarea class="form-control" id="issue" name="message">{{old('message')}}</textarea>
                    </div>
                    <button type="submit" class="btn form-submit-btn btn-outline-custom  btn-blue col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 uppercase">{{__('_site_contact.save')}}</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection