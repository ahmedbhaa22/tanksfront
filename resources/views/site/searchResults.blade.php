@extends('template')

@section('title', 'نتائج البحث')

@section('content')
    <div class="container-fluid no-padding about-page page-body">
        <div class="container">

            <h3 class="main-title uppercase">
                {{__('_site_search_results.search_results')}}
            </h3>
            <div class="container">
                <h4 id="no-results" hidden class="row text-danger">{{__('_site_search_results.no_results')}}</h4>
                <h4 class="row"><span id="results-count">0</span>{{__('_site_search_results.results')}}</h4>

                <div hidden id="offers-results" class="row">
                </div>

                <div class="clearfix"></div>

                <div hidden id="products-results" class="row">
                </div>

                <div class="clearfix"></div>

                <div hidden id="events-results" class="row">
                </div>

                <div class="clearfix"></div>

                <div hidden id="categories-results" class="row">
                </div>

                </div>
        </div>
    </div>
@endsection

@section('bottom_scripts')

    <script>
        // define in-code usage variables
        var products_result   = [];
        var categories_result = [];
        var offers_result     = [];
        var events_result     = [];

        // define html elemnts variables
        var offers_container     = $('#offers-results');
        var products_container   = $('#products-results');
        var events_container     = $('#events-results');
        var categories_container = $('#categories-results');
        var results_count_span   = $('#results-count');

        // render the offer event item
        var offerItem = (function(item)
        {
            var html = "<ol class='search-breadcrumb breadcrumb'>" +
                    "<li class='saerch-breadcrumb-item breadcrumb-item'>" +
                    "<a href='{{route('offers')}}'>عروض</a></li></ol>";

            html += "<a href='"+base_url+'/store/offer-details/'+item.id+'/'+item.id+"'>" +
                    "<h4 class='uppercase'>"+item.name+"</h4></a>";
            html += "<div class='clearfix'></div>";
            html += item.desc+"... <a href='"+base_url+'/store/offer-details/'+item.id+'/'+item.id+"'>المزيد</a>";
            html += "<hr/>";

            return html;
        });

        // render th product event item
        var productItem = (function(item)
        {
            var html = "<ol class='search-breadcrumb breadcrumb'>" +
                    "<li class='saerch-breadcrumb-item breadcrumb-item'>" +
                    "<a href='"+base_url+'/store/shopping-center'+"'>منتجات</a></li>" +
                    "<li class='fa fa-chevron-right' aria-hidden='true'></li>" +
                    "<li class='search-breadcrumb-item breadcrumb-item active'>"+item.name+"</li></ol>";
            html += "<a href='"+base_url+'/store/product-details/'+item.id+'/'+item.id+"'>" +
                    "<h4 class='uppercase'>"+item.name+"</h4></a>";
            html += "<div class='clear-fix'></div>";
            html += item.desc + "... <a href='"+base_url+'/store/product-details/'+item.id+'/'+item.id+"'>المزيد</a>";
            html += "<hr/>";

            return html;
        });

        // render the event search item
        var eventItem = (function(item)
        {
            var html = "<ol class='search-breadcrumb breadcrumb'>" +
                    "<li class='saerch-breadcrumb-item breadcrumb-item'>" +
                    "<a href='"+base_url+'/events'+"'>الأحداث</a></li>" +
                    "<li class='fa fa-chevron-right' aria-hidden='true'></li>" +
                    "<li class='search-breadcrumb-item breadcrumb-item active'>"+item.name+"</li></ol>";
            html += "<a href='"+base_url+'/event-details/'+item.id+'/'+item.id+"'>" +
                    "<h4 class='uppercase'>"+item.name+"</h4></a>";
            html += "<div class='clear-fix'></div>";
            html += item.desc + "... <a href='"+base_url+'/event-details/'+item.id+'/'+item.id+"'>المزيد</a>";
            html += "<hr/>";

            return html;
        });

        // render the categor search item
        var categoryItem = (function(item)
        {
            var html = "<ol class='search-breadcrumb breadcrumb'>" +
                    "<li class='saerch-breadcrumb-item breadcrumb-item'>" +
                    "<a href='"+base_url+'/store/shopping-center'+"'>الأقسام</a></li>" +
                    "<li class='fa fa-chevron-right' aria-hidden='true'></li>" +
                    "<li class='search-breadcrumb-item breadcrumb-item active'>"+item.name+"</li></ol>";
            html += "<a href='"+base_url+'/product-category/'+item.id+'/'+item.id+"'>" +
                    "<h4 class='uppercase'>"+item.name+"</h4></a>";
            html += "<div class='clear-fix'></div>";
            html += item.desc + "... <a href='"+base_url+'/product-category/'+item.id+'/'+item.id+"'>المزيد</a>";
            html += "<hr/>";

            return html;
        });

        // hide no results message function
        var hideNoResultsMessage = (function()
        {
            $("#no-results").fadeOut();
        });

        // show no results message function
        var showNoResultsMessage = (function()
        {
            $("#no-results").fadeIn();
        });

        // search products function
        var searchProducts = (function (keyword, token)
        {
            return $.ajax({
                type: 'post',
                url: "{{route('search-products')}}",
                data:{
                    keyword: keyword,
                    _token: token
                }
            });
        });

        // search categories function
        var searchCategories = (function (keyword, token)
        {
            return $.ajax({
                type: 'post',
                url: "{{route('search-categories')}}",
                data:{
                    keyword: keyword,
                    _token: token
                }
            });
        });

        // search offers function
        var searchOffers = (function(keyword, token)
        {
            return $.ajax({
                type: 'post',
                url: "{{route('search-offers')}}",
                data:{
                    keyword: keyword,
                    _token: token
                }
            });
        });

        // search events function
        var searchEvents = (function(keyword, token)
        {
            return $.ajax({
                type: 'post',
                url: "{{route('search-events')}}",
                data:{
                    keyword: keyword,
                    _token: token
                }
            });
        });

        // show products result
        var showProductsResult = (function()
        {
            products_container.fadeIn();
            products_result.forEach(function(item)
            {
                products_container.append(productItem(item));
            });
        });

        // show categories result
        var showCategoriesResult = (function()
        {
            categories_container.fadeIn();
            categories_result.forEach(function(item)
            {
                categories_container.append(categoryItem(item));
            });
        });

        // show offers result
        var showOffersResult = (function()
        {
            offers_container.fadeIn();
            offers_result.forEach(function(item)
            {
                offers_container.append(offerItem(item));
            });
        });

        // show events result
        var showEventsResult = (function()
        {
            events_container.fadeIn();
            events_result.forEach(function(item)
            {
                events_container.append(eventItem(item));
            });
        });

        // show search results
        var handleShowingResults = (function()
        {
            if(products_result.length)
            {
                showProductsResult();
            }

            if(categories_result.length)
            {
                showCategoriesResult();
            }

            if(offers_result.length)
            {
                showOffersResult();
            }

            if(events_result.length)
            {
                showEventsResult();
            }
        });

        // function to count all of the results
        function countResults()
        {
            return products_result.length + categories_result.length + offers_result.length + events_result.length;
        }


        // document.ready logic
        $(document).ready(function()
        {
            $.when(searchProducts("{{$search_keyword}}", "{{csrf_token()}}"), searchCategories("{{$search_keyword}}", "{{csrf_token()}}"), searchOffers("{{$search_keyword}}", "{{csrf_token()}}"), searchEvents("{{$search_keyword}}", "{{csrf_token()}}")).done(function(ajx_products_result, ajx_categories_result, ajx_offers_result, ajx_events_result)
            {
                if(ajx_products_result)
                {
                    if(ajx_products_result[0].status === 1)
                    {
                        products_result   = ajx_products_result[0].content;
                    }
                }

                if(ajx_categories_result)
                {
                    if(ajx_categories_result[0].status === 1)
                    {
                        categories_result = ajx_categories_result[0].content;
                    }
                }

                if(ajx_offers_result)
                {
                    if(ajx_offers_result[0].status === 1)
                    {
                        offers_result     = ajx_offers_result[0].content;
                    }
                }

                if(ajx_events_result)
                {
                    if(ajx_events_result[0].status === 1)
                    {
                        events_result     = ajx_events_result[0].content;
                    }
                }

                if(products_result.length || categories_result.length || offers_result.length || events_result.length)
                {
                    handleShowingResults();
                    results_count_span.text(countResults());
                }
                else
                {
                    showNoResultsMessage();
                }

            });
        });
    </script>
@endsection