{{--<ol class="breadcrumb">--}}
    {{--<li class="breadcrumb-item"><a href="#">--}}
            {{--<i class="fa fa-home" aria-hidden="true"></i> الرئيسية</a></li>--}}
    {{--<i class="fa fa-chevron-right" aria-hidden="true"></i>--}}
    {{--<li class="breadcrumb-item active">من نحن</li>--}}
{{--</ol>--}}

@if (count($breadcrumbs))

    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $key => $breadcrumb)
            @if($key == 0)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">
                        <i class="fa fa-home" aria-hidden="true"></i> {{ $breadcrumb->title }}</a></li>
            @else
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif
            @endif
        @endforeach
    </ol>

@endif