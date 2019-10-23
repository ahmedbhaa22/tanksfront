@extends('template')

@section('title', $page['name'])

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container">

        {{ Breadcrumbs::render('profile') }}

        <div class="container">

            <h3 class="main-title uppercase">
                {{ $page['name'] }}
            </h3>

            <div class="row">

                @if(isset($page['cms']) && count($page['cms']))
                    @foreach($page['cms'] as $entry)
                        <div class="col-md-3">
                            <div class=" block-div">
                                <h4>{{ $entry['name'] }}</h4>
                                <a href="{{$entry['more']['pdf_url']}}" target="_blank">
                                    <img alt="{{ $entry['name'] }}" src="{{ asset('public/img/acp-pdf.png') }}" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <br/>
        </div>
    </div>
    </div>
@endsection