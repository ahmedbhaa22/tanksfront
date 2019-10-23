@extends('template')

@section('title', "Store | Offers")

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container product-details-page">

        {{ Breadcrumbs::render('offers') }}

        <div class="container">
            <h3 class="main-title uppercase">
                {{__('_store_offers.offers')}}
            </h3>
            <div class="col-md-12 sec-nav">
                <div class="form-group">
                    <label class="col-xs-3" for="district">{{__('_store_offers.choose_region')}}</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="district-dropdown">
                            <option value="">{{__('_store_offers.all_regions')}}</option>
                            @foreach($regions as $region)
                                <option value="{{$region['id']}}">{{$region['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 offers gap no-padding" id="offers-block">

            </div>
        </div>
    </div>
    </div>
    @include('partials._modals')
@endsection

@section('bottom_scripts')

    {!! Html::script('public/js/functions.js') !!}

    <script>
        $(document).ready(function () {
            get_offers_by_region($("#district-dropdown").val());
            $("#district-dropdown").change(function () {
                get_offers_by_region($(this).val());
            });
        });
    </script>

@endsection