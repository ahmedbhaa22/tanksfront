@extends('template')

@section('title', $page['name'])

@section('content')
<div class="container-fluid no-padding about-page page-body">
    <div class="container">

        {{ Breadcrumbs::render('about-us', $page) }}

    <div class="container">

        <h3 class="main-title uppercase text-center">
            {{ $page['name'] }}
        </h3>
        <p>
            {{ $page['description'] }}
        </p>
        <div class="col-md-12 no-padding">
            <div class="col-xs-12">
                <h4 class="uppercase main-title">
                    <a href="#">{{__('_site_about.gallery')}}</a>
                </h4>
            </div>
            @if(isset($page['media']) && count($page['media']))
                @foreach($page['media'] as $media)
                    <div class="col-md-2 col-sm-6 col-xs-12  no-padding">
                        @if($media['type'] == "Video")
                            <a href="{{ $media['link'] }}" item-type="video" item-video-id="{{ (Helpers::getYoutubeVideoId($media['link'])) }}" class="gal-item">
                                <i class="fa fa-play-circle-o"></i>
                                <img src="{{ $media['image'] }}"
                                     class="full-width centered-and-cropped"/>
                            </a>
                        @else
                            <a href="{{ $media['image'] }}" item-type="image" class="gal-item">
                                <img src="{{ $media['image'] }}" class="full-width centered-and-cropped"/>
                            </a>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
</div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body" id="modal-body">

                        <div class="container"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('_site_about.close')}}</button>
                    </div>
                </div>

            </div>
        </div>

@endsection

@section('bottom_scripts')
    <script>
        $(".gal-item").on("click", function(e){
           e.preventDefault();
           e.stopPropagation();
           var ele = $(this);
            if(ele.attr("item-type") == "image") {
                var html = '<img src="'+(ele.attr('href'))+'" class="full-width" />';
            } else {
                var html = ` <iframe width="100%" height="390" src="http://www.youtube.com/embed/`+(ele.attr('item-video-id'))+`" frameborder="0" allowFullScreen></iframe> `;
            }
            $("#modal-body").html(html);
            $("#myModal").modal("show");
        });
    </script>
@endsection