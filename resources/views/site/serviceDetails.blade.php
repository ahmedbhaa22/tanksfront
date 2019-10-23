@extends('template')

@section('title', $service['name'])

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('service-details', $service) }}


            <div class="col-md-6">
                @include('partials._productMedia', ['product' => $service])
            </div>

            <div class="col-md-6 col-sm-6  no-padding product-details-col pro-middle-col">
                <h4 class="product-title uppercase col-md-12 no-padding">
                    {{$service['name']}}
                </h4>
                <div class="clearfix"></div>
                <p>
                    {!! html_entity_decode($service['content']) !!}
                </p>
                <span class="stars" data-rating="1" data-num-stars="5"></span>
                <div class="clearfix"></div>

                <div class="price-container">
                    <h4>{{__('_site_service_details.call_on')}}</h4>
                    <div>
                        <i class="fa fa-phone"></i>
                        <a href="tel:0123456789">0123456789</a>
                    </div>
                    <div>
                        <i class="fa fa-phone"></i>
                        <a href="tel:0123456789">0123456789</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <br/>

            </div>
            <div class="clearfix"></div>
            <ul class="nav nav-tabs nav-justified products-tabs">
                <li class="{{!isset($_GET['VisitRequest'])?'active':''}}"><a data-toggle="tab" href="#overview">{{__('_site_service_details.general_view')}}</a></li>
                <li class="{{isset($_GET['VisitRequest'])?'active':''}}"><a data-toggle="tab" href="#VisitRequest">{{__('_site_service_details.request_visit')}}</a></li>

            </ul>
            <div class="tab-content products-tab-content">
                <div id="overview" class="tab-pane fade {{!isset($_GET['VisitRequest'])?'in active':''}} col-xs-12">
                    <p>
                        {!! html_entity_decode($service['content']) !!}
                    </p>
                </div>
                <div id="VisitRequest" class="tab-pane fade {{isset($_GET['VisitRequest'])?'in active':''}}  col-xs-12">

                    @include('partials._formMessages')

                    <form method="post" action="{{route('request-visit')}}" class="bordered  col-md-8 col-md-offset-2 col-xs-12 col-md-offset-0 ">
                        <span class="error-line text-danger">{{__('_site_service_details.required')}}</span>
                        {{csrf_field()}}
                        <div class="form-group float-label-control">
                            <label for="date">{{__('_site_service_details.suggested_date')}}</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{old('date')}}">
                        </div>
                        <div class="form-group float-label-control">
                            <label for="name">{{__('_site_service_details.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        </div>
                        <div class="form-group  float-label-control">
                            <label for="mobile">{{__('_site_service_details.mobile')}}</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile" value="{{old('mobile')}}">
                        </div>
                        <div class="form-group  float-label-control">
                            <label for="address">{{__('_site_service_details.visit_place')}}</label>
                            <input type="text" class="form-control" id="address" name="location" value="{{old('location')}}">
                        </div>
                        <input type="hidden" name="current_url" value="{{url()->current()."?VisitRequest=1"}}" />
                        <button type="submit" class="btn form-submit-btn btn-outline-custom btn-blue uppercase col-md-6 col-md-offset-3 col-xs-8 col-xs-offset-2">{{__('_site_service_details.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection