@extends('template')

@section('title', "Store | Compare Products")

@section('content')

    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('compare-product') }}

            <div class="container">
                <h3 class="main-title uppercase text-center">
                    {{__('_store_compare.compare_products')}}
                </h3>
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <tbody>
                            <tr>
                                <th></th>
                                @foreach($productData['images'] as $image)
                                    <td>
                                        <div class="product-list-img-div">
                                            <div class="product-list-img" style="background-image:url('{{ $image }}')"></div>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>{{__('_store_compare.name')}}</th>
                                @foreach($productData['names'] as $names)
                                    <td>{{$names}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>{{__('_store_compare.description')}}</th>
                                @foreach($productData['descs'] as $desc)
                                    <td>
                                        {{$desc}}
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>{{__('_store_compare.delivery')}}</th>
                                @foreach($productData['deliveries'] as $date)
                                    <td>{{$date}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>{{__('_store_compare.factory')}}</th>
                                @foreach($productData['manufacturers'] as $manufacturer)
                                    <td>{{$manufacturer}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>{{__('_store_compare.price')}}</th>
                                @foreach($productData['prices'] as $price)
                                    <td>{{$price}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>{{__('_store_compare.avail_colors')}}</th>
                                    <td>
                                        @if($productData['colors'])
                                            @foreach($productData['colors'] as $color)
                                                @foreach($color as $item)
                                                    {{$item['value_title'].($loop->last?"":" - ")}}
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </td>

                            </tr>
                            <tr>
                                <th>{{__('_store_compare.delivery_places')}}</th>
                                @foreach($productData['delivery_places'] as $place)
                                    <td>{{$place[1]['value']??""}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <th></th>
                                @foreach($productData['ids'] as $key => $id)
                                    <td>
                                        <a href="{{ url('store/product-details/'.$id.'/'.Helpers::str2url($productData['names'][$key])) }}" class="btn btn-primary btn-sm add-to-cart" title="add to cart">
                                            <i class="fa fa-shopping-bag"></i>
                                        </a>
                                        <a href="#"class="btn btn-danger btn-sm gap-left clear-product" data-id="{{$id}}" title="remove">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials._modals')
@endsection

@section('bottom_scripts')
    {!! Html::script('public/js/functions.js') !!}
    <script>
        $(".clear-product").on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var item = $(this);
            remove_compared(item.attr('data-id'), '{{csrf_token()}}');
            var colnum = item.closest("td").prevAll("td").length;

            item.closest("table").find("tr").find("td:eq(" + colnum + ")").remove();

            return false;
        });

        $.fn.stars = function () {
            return $(this).each(function () {
                var rating = $(this).data("rating");
                var numStars = $(this).data("numStars");
                var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');
                var halfStar = ((rating % 1) !== 0) ? '<i class="fa fa-star-half-empty"></i>' : '';
                var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');
                $(this).html(fullStar + halfStar + noStar);
            });
        }
        $('.stars').stars();
    </script>

@endsection