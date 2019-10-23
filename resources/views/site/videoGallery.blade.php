@extends('template')

@section('title', "Video Gallery")

@section('content')
    <div class="container-fluid no-padding about-page page-body">
    <div class="container">

        {{ Breadcrumbs::render('video-gallery') }}

        <div class="container">

            <h3 class="main-title uppercase text-center">{{__('_site_video_gallery.gallery')}}</h3>
            <div class="col-md-12 no-padding">

                @if(count($galleries))
                    @foreach($galleries as $media)
                        <div class="col-md-2 col-sm-6 col-xs-12  no-padding">
                            <a href="{{ $media['link'] }}" item-type="video" item-video-id="{{ (Helpers::getYoutubeVideoId($media['link'])) }}" class="gal-item">
                                <i class="fa fa-play-circle-o"></i>
                                <img src="{{ $media['image'] }}"
                                     class="full-width centered-and-cropped"/>
                            </a>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('_site_video_gallery.close')}}</button>
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
            var ele = $(this)
            var html = ` <iframe width="100%" height="390" src="http://www.youtube.com/embed/`+(ele.attr('item-video-id'))+`" frameborder="0" allowFullScreen></iframe> `;

            $("#modal-body").html(html);
            $("#myModal").modal("show");
        });
    </script>
@endsection