@extends('template')

@section('title', "Careers Apply")

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container">

        {{ Breadcrumbs::render('careers') }}

        <div class="container">

            <h3 class="main-title uppercase text-center">
                {{__('_site_careers_apply.join_us')}}
            </h3>
            <form class="bordered  col-md-8 col-md-offset-2 col-xs-12 col-md-offset-0 ">
                <div class="form-group float-label-control">
                    <label for="name">{{__('_site_careers_apply.name')}}</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group  float-label-control">
                    <label for="age">{{__('_site_careers_apply.age')}}</label>
                    <input type="number" class="form-control" id="age" min="1" max="100">
                </div>
                <div class="form-group">
                    <label for="country">{{__('_site_careers_apply.country')}}</label>
                    <select class="form-control" id="country">
                        <option>البلد 1</option>
                        <option>البلد 2</option>
                        <option> البلد 3</option>
                    </select>
                </div>
                <div class="form-group  float-label-control">
                    <label for="mobile">{{__('_site_careers_apply.mobile')}}</label>
                    <input type="tel" class="form-control" id="mobile">
                </div>
                <div class="form-group  float-label-control">
                    <label for="address">{{__('_site_careers_apply.address')}}</label>
                    <input type="text" class="form-control" id="address">
                </div>
                <div class="form-group  float-label-control">
                    <label for="your-title">{{__('_site_careers_apply.job_title')}}</label>
                    <input type="text" class="form-control" id="your-title">
                </div>
                <div class="form-group  float-label-control">
                    <label for="previous-experience">{{__('_site_careers_apply.experience')}}</label>
                    <textarea class="form-control" id="previous-experience"></textarea>
                </div>
                <div class="form-group  float-label-control">
                    <label for="email">{{__('_site_careers_apply.email')}}</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="form-group form-control">
                    <label for="cv">{{__('_site_careers_apply.attach_cv')}}</label>
                    <label for="cv-upload" class="custom-file-upload col-xs-5  col-sm-4 col-md-2 text-center uppercase">
                        ارفع الملف
                    </label>
                    <input id="cv-upload" type="file" />
                </div>
                <button type="submit" class="btn form-submit-btn btn-outline-custom btn-blue uppercase col-md-6 col-md-offset-3 col-xs-8 col-xs-offset-2">{{__('_site_careers_apply.save')}}</button>
            </form>
            <div class="col-md-12">
                <p class="text-center">{{__('_site_careers_apply.have_account')}}<a href="login-ar.html" class="uppercase">{{__('_site_careers_apply.login')}}</a></p>
            </div>
        </div>
    </div>
    </div>
@endsection