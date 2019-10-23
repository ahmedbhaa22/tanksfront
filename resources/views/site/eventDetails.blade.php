@extends('template')

@section('title', $event['name'])

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container">

                {{ Breadcrumbs::render('event-details', $event) }}

        <div class="container">

            <h3 class="main-title uppercase gap-left">
               {{$event['name']}}
            </h3>
            <p class="pull-left text-primary gap-left">
                <i class="fa fa-calendar" aria-hidden="true"></i> {{ date("Y F d-h:m am", $event['created_at']) }}
            </p>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <img src="{{ $event['image'] }}" class="full-width" />
            </div>
            <div class="col-md-8">
                <p class=" text-left">
                    {!! html_entity_decode($event['content']) !!}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection