<div class="carousel slide article-slide" id="article-photo-carousel">
    <div class="col-xs-9">
        <!-- Wrapper for slides -->
        <div class="carousel-inner cont-slider">
            <div class="item active">
                <img alt="" title="" class="no-padding" src="{{ $product['image'] }}">
            </div>
            @if(count($product['media']))
                @foreach($product['media'] as $key => $media)
                    @if($media['type'] == 'Img')
                        <div class="item">
                            <img alt="" title="" class="no-padding" src="{{ $media['image'] }}">
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-xs-3">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li class="active" data-slide-to="0" data-target="#article-photo-carousel">
                <img alt="" src="{{ $product['image'] }}">
            </li>
            @if(count($product['media']))
                @foreach($product['media'] as $key => $media)
                    @if($media['type'] == 'Img')
                        <li data-slide-to="{{$key}}" data-target="#article-photo-carousel">
                            <img alt="" src="{{ $media['image'] }}">
                        </li>
                    @endif
                @endforeach
            @endif
        </ol>
    </div>
</div>