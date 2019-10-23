@extends('template')

@section('title', $page['name'])

@section('content')
<div class="container-fluid no-padding page-body">
    <div class="container">

        {{ Breadcrumbs::render('page', $page) }}

    <div class="container">

        <h3 class="main-title uppercase text-center">
            {{ $page['name'] }}
        </h3>
        <p>
            {{ $page['description'] }}
        </p>
    </div>
</div>
</div>

@endsection