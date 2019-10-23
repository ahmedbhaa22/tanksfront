@extends('template')

@section('title', "Store | Manufacturers")

@section('content')
    <div class="container-fluid no-padding manufactures-page page-body">
        <div class="container">

            {{ Breadcrumbs::render('manufactures') }}

            <div class="container">
                <div class="col-xs-12 clearfix">
                    <div class=" main-title">
                        <h4 class="pull-left uppercase no-padding">
                            {{__('_store_manufacturers.manufacturers')}}
                        </h4>
                    </div>
                </div>

                <div class="col-xs-12 gap clearfix">
                    @if(count($manufacturers))
                        @foreach($manufacturers as $manfacturer)
                    <a href="{{ url('store/shopping-center?filterManf[]='.$manfacturer['id']) }}" class="col-md-2 col-sm-3 col-xs-6 brand-one">
                        <div class="brand-img">
                            <img src="{{ $manfacturer['image'] }}" alt="{{ $manfacturer['name'] }}">
                        </div>
                        <div class="brand-desc">
                            <h2>{{ $manfacturer['name'] }}</h2>
                        </div>
                    </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection