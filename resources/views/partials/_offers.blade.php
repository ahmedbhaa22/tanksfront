@if($offers)
    @foreach($offers as $offer)
        <div class="col-lg-3 col-md-4 col-xs-6  product-list-img-div">
            <div class="one-product-container">
                <div class="thumbnail one-product-div">
                    <img src="{{ $offer['image'] }}" class="full-width">
                    <div class="caption">
                        <a class="{{ url('store/offer-details/'.$offer['id'].'/'.Helpers::str2url($offer['name'])) }}"><b>{{ $offer['name'] }}</b></a>
                        <p class="product-price">{{ Helpers::getProductKeyValueItemText($offer, 'price') }} SAR
                            <strike class="pull-right">{{ Helpers::getProductKeyValueItemText($offer, 'original_price') }} SAR</strike>
                        </p>
                    </div>
                </div>
                <div class="overlay thumbnail col-xs-12">
                    <a href="{{ url('store/offer-details/'.$offer['id'].'/'.Helpers::str2url($offer['name'])) }}" class="btn btn-outline-custom btn-white first-btn col-xs-8 col-xs-offset-2">التفاصيل</a>
                    <a href="{{ url('store/offer-details/'.$offer['id'].'/'.Helpers::str2url($offer['name'])) }}" class="btn btn-outline-custom btn-white col-xs-8 col-xs-offset-2" data-id="{{$offer['id']}}">اضف لعربة التسوق</a>
                    <a href="#" class="btn btn-outline-custom btn-white col-xs-4 col-xs-offset-4 add_to_wish_list" data-id="{{$offer['id']}}"><i class="fa fa-heart-o"></i></a>
                </div>
            </div>
        </div>
    @endforeach
@endif

{!! Html::script('public/js/functions.js') !!}


<script>
    $(document).ready(function () {
        {{--$(".add-to-cart").on("click", function(e){--}}
            {{--e.preventDefault();--}}
            {{--e.stopPropagation();--}}
            {{--var item = $(this);--}}
            {{--add_to_cart(item.attr('data-id'), 1, 2, '{{csrf_token()}}');--}}
        {{--});--}}

        $(".add_to_wish_list").on("click", function(e){
            e.preventDefault();
            e.stopPropagation();
            var item = $(this);
            add_to_wish_List(item.attr('data-id'), 2, '{{csrf_token()}}');
        });
    });
</script>