@extends('template')

@section('title', "Our Factory")

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container">

        {{ Breadcrumbs::render('factory') }}

        <div class="container">

            <h3 class="main-title uppercase">
                {{__('_site_factory.factory')}}
            </h3>
            <div class="col-md-12">

                @if(count($factories))
                    @php
                        $counter = 0;
                    @endphp
                    @foreach($factories as $factory)
                        @php
                            $counter++;
                        @endphp

                        <h4 class="product-title uppercase col-md-12 no-padding">
                            {{ $counter.". ". $factory['name'] }}
                        </h4>
                        <div class="row">
                            @if(isset($factory['cms']) && count($factory['cms']))
                                @foreach($factory['cms'] as $entry)
                                    <div class="col-md-12">
                                        <div class=" ">
                                            <h5 class="product-title  col-md-12 ">{{ $entry['name'] }}:</h5>
                                            <div>
                                                {!!  html_entity_decode($entry['content']) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="clearfix"></div> <hr>
                    @endforeach
                @endif
            </div>
            <br/>
        </div>
    </div>
    </div>
@endsection