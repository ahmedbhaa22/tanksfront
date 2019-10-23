@extends('template')

@section('title', "Events")

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container">

        {{ Breadcrumbs::render('events') }}

        <div class="container">

            <h3 class="main-title uppercase">
                {{__('_site_events.events')}}
            </h3>

            @foreach($events as $event)
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="thumbnail">
                    <a href="{{ url("event-details/{$event['id']}/".str_slug($event['name'])) }}">
                        <div class="event-div half-height" style="background-image:url({{ $event['image'] }})">
                            <aside>
                                <p> <i class="fa fa-calendar" aria-hidden="true"></i> {{ date("Y F d", $event['created_at']) }} </p>
                            </aside>
                        </div>
                    </a>
                    <div class="caption">
                        <a href="{{ url("event-details/{$event['id']}/".Helpers::str2url($event['name'])) }}"><b>{{ $event['name'] }}</b></a>
                        <p>{{ mb_substr($event['description'], 0, 20, "utf-8") }}...
                            <a href="{{ url("event-details/{$event['id']}/".Helpers::str2url($event['name'])) }}" class=" gap-left">{{__('_site_events.more')}}</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection