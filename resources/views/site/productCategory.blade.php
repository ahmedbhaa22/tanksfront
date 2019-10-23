@extends('template')

@section('title', $category['name'])

@section('content')
    <div class="container-fluid no-padding page-body">
<div class="container">

        {{ Breadcrumbs::render('product-category', $category) }}

        @if($childCats)
            <nav class="navbar navbar-default sec-nav">
                <div class="container">
                    <ul class="nav navbar-nav">
                        @foreach($childCats as $cat)
                            <li class="uppercase"><a href="{{ url('product-category/'.$cat['childe_id'].'/'.Helpers::str2url($cat['child_name'])) }}">{{$cat['child_name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        @endif
        <div class="col-md-12 no-padding">
            <h4 class="uppercase main-title">
                {{$category['name']}}
                <span class="pull-right"></span>
            </h4>
        </div>

        <div class="col-sm-7">
            <h4>{{$category['name']}}</h4>

            <p>
                {!! html_entity_decode($category['description']) !!}
            </p>

            <img src="{{$category['image']}}" width="400" height="400" class="img-responsive">
        </div>

        <div class="col-sm-5">
            @include('partials._productMedia', ['product' => $category])
        </div>
        <div class="clearfix"></div> <br>
    @if($category['more']['attributes'])
        <h4 class="uppercase main-title">
            {{__('_site_category_product.products')}}
            <span class="pull-right"></span>
        </h4>

        <div  class="bordred-div product-details-table-div">
            <table class="table table-striped" id="products_category_table">
                <thead>
                    <tr>
                        <th scope="col" class="rgHeader" style="text-align:right;">{{__('_site_category_product.product')}}</th>
                        @foreach($category['more']['attributes'] as $attributeName)
                            <th scope="col" class="rgHeader" style="text-align:right;">{{$attributeName}}</th>
                        @endforeach
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($products as $product)
                            <tr class="rgAltRow" id="ctl00_MainContentPlaceHolder_ProductsDetails1_RepeaterMain_ctl00_RadGrid1_ctl00__1">
                                <td style="text-align: right;">
                                    <a href="{{route('product-details', ['id' => $product['id'], 'slug' => Helpers::str2url($product['name'])])}}" class="btn">{{$product['name']}}</a>
                                </td>


                                @foreach(Helpers::getProductGroup($product, 'attributes') as $attribute)
                                    <td style="text-align: right;">
                                        {{$attribute['value']['value_title']??""}}
                                    </td>
                                @endforeach
                                <td style="width:50px;">
                                    <a href="{{route('product-details', ['id' => $product['id'], 'slug' => Helpers::str2url($product['name'])])}}" class="btn add-to-cart ">{{__('_site_category_product.details')}}</a>
                                </td>
                            </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
            @endif
    </div>
    </div>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

    <script>
        $.extend( true, $.fn.dataTable.defaults, {
            "searching": false,
           // "ordering": false,
            "paging": false,
            "bInfo": false
        } );
        $(document).ready(function() {

            $('#products_category_table').DataTable( {
                "order": [[ 7, "asc" ]]
            } );
        } );
    </script>
@endsection
