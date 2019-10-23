@extends('template')

@section('title', "Photo Gallery")

@section('content')
    <div class="container-fluid no-padding about-page page-body">
    <div class="container">

        {{ Breadcrumbs::render('photo-gallery') }}

        <div class="container">
            <h3 class="main-title uppercase text-center">{{__('_site_photo_gallery.gallery')}}</h3>
            <div class="col-md-12 no-padding">
                @if(count($galleries))
                    @foreach($galleries as $media)
                        <div class="col-md-2 col-sm-6 col-xs-12  no-padding">
                            <a href="{{ $media['image'] }}" item-type="image" class="gal-item">
                                <img src="{{ $media['image'] }}" class="full-width centered-and-cropped"/>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('_site_photo_gallery.close')}}</button>
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
            var html = '<img src="'+(ele.attr('href'))+'" class="full-width" />';
            $("#modal-body").html(html);
            $("#myModal").modal("show");
        });
    </script>
@endsection