<nav class="navbar  navbar-fixed-top">
    <div class="text-center upper-nav">

        <div class="container">
            <div class="row">
                <div class="col-md-2 col-xs-12">
                    <a href="{{ url('/') }}"><img class="logo col-xs-12" src="{{ asset('public/img/logo.png') }}" /></a>
                </div>
                <div class="col-md-8 col-sm-10 col-xs-9 search ">
                    <form action="{{route('search')}}" method="get" enctype="multipart/form-data">
                        <!-- {{csrf_field()}} -->
                        <input value="" name="keyword" type="search" placeholder="{{__('_header.search')}}" />
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                        {{--<a href="{{route('search')}}" class="cstm-subscribe-btn">--}}
                            {{--<i class="fa fa-search"></i>--}}
                        {{--</a>--}}

                    </form>
                </div>
                <div class="col-sm-2 col-xs-3 header-cart">
                    <a href="{{ url('store/shopping-cart') }}" title="shopping cart" id="cart_link">
                        <div class="col-xs-8 no-padding remove--screen">
                            <label for="cart_items" class="cart_text">{{__('_header.cart')}}</label>
                            @if(Session::get('loggedIn') == true)
                                <div id="cart_items">
                                    <!-- @if(\Session::get('cart_count') > 0 )
                                        <span id="item_count">{{\Session::get('cart_count')}}</span><span> منتجات</span>
                                    @endif -->
                                        <span id="item_count">{{Helpers::getCartCount()}}</span><span> {{__('_header.cart_products')}}</span>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-4 col-xs-12 no-padding">
                            <i class="fa fa-shopping-bag">@if(Session::get('loggedIn') == true) <span class="badge badge-default"> {{Helpers::getCartCount()}} </span> @endif</i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div id="main-navbar" class="main-navbar ">
            <div class="container">
                <div class="navbar-header pull-right">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is("/")?'active':'' }}"><a href="{{ url('/') }}">{{__('_header.home')}}</a></li>
                        <li class="{{ Request::is("store")?'active':'' }}"><a href="{{ url('store') }}">{{__('_header.store')}}</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> {{__('_header.products')}}
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @if(Helpers::getCategoryTree())
                                        @foreach(Helpers::getCategoryTree() as $cat)
                                            @if(count($cat['children']))
                                                <li class="dropdown-submenu"><a href="{{ url('product-category/'.$cat['parent_id'].'/'.Helpers::str2url($cat['parent_name'])) }}"> {{$cat['parent_name']}}</a>
                                                    <ul class="dropdown-menu">
                                                        @foreach($cat['children'] as $child)
                                                            <li><a href="{{ url('product-category/'.$child['childe_id'].'/'.Helpers::str2url($child['child_name'])) }}">{{$child['child_name']}}</a></li>
                                                        @endforeach
                                                    </ul>
                                            @else
                                                <li><a href="{{ url('product-category/'.$cat['parent_id'].'/'.Helpers::str2url($cat['parent_name'])) }}">{{ $cat['parent_name'] }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                        </li>
                        {{-- services --}}
                        {{-- <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{__('_header.services')}}
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @if(Helpers::getServicesTree())
                                        @foreach(Helpers::getServicesTree() as $cat)
                                            @if(count($cat['children']))
                                                <li class="dropdown-submenu"><a href="#"> {{$cat['parent_name']}}</a>
                                                    <ul class="dropdown-menu">
                                                        @foreach($cat['children'] as $child)
                                                            <li><a href="{{ url('service-details/'.$child['childe_id'].'/'.Helpers::str2url($child['child_name'])) }}">{{$child['child_name']}}</a></li>
                                                        @endforeach
                                                    </ul>
                                            @else
                                                <li><a href="{{ url('service-details/'.$cat['parent_id'].'/'.Helpers::str2url($cat['parent_name'])) }}">{{ $cat['parent_name'] }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                        </li> --}}
                        {{-- end services --}}

                        {{-- about us --}}
                        {{-- <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{__('_header.about_us')}}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::is("about-us")?'active':'' }}"><a href="{{ url('about-us') }}">{{__('_header.about_us')}}</a></li>
                                <li class="{{ Request::is("profile")?'active':'' }}"><a href="{{ url('profile') }}">{{__('_header.profile')}}</a></li>
                                <li class="{{ Request::is("branches")?'active':'' }}"><a href="{{ url('branches') }}">{{__('_header.branches')}}</a></li>
                                <li class="{{ Request::is("factory")?'active':'' }}"><a href="{{ url('factory') }}">{{__('_header.factory')}}</a></li>
                                <li class="{{ Request::is("brochures")?'active':'' }}"><a href="{{ url('brochures') }}">{{__('_header.brochures')}}</a></li>
                            </ul>
                        </li> --}}
                        {{-- end about us --}}

                        {{-- media --}}
                        {{-- <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{__('_header.media')}}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::is("events")?'active':'' }}"><a href="{{ url('events') }}">{{__('_header.events')}}</a></li>
                                <li class="{{ Request::is("photo-gallery")?'active':'' }}"><a href="{{ url('photo-gallery') }}">{{__('_header.photo_gallery')}}</a></li>
                                <li class="{{ Request::is("video-gallery")?'active':'' }}"><a href="{{ url('video-gallery') }}">{{__('_header.video_gallery')}}</a></li>
                            </ul>
                        </li> --}}
                        {{-- end media --}}
                        <li class="{{ Request::is("contact-us")?'active':'' }}"><a href="{{ url('contact-us') }}">{{__('_header.contact_us')}}</a></li>

                        {{-- others --}}
                        {{-- <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{__('_header.other')}}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach(Helpers::getOtherPages() as $page)
                                    <li><a href="{{ url('page/'.$page['id'].'/'.Helpers::str2url($page['name'])) }}"> {{$page['name']}} </a> </li>
                                @endforeach
                            </ul>
                        </li> --}}
                        {{-- end others --}}
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if(Session::get('loggedIn') == true)
                            <li class="icon">
                                <a href="{{ route('wish-list') }}" title="wishlist">
                                    <i class="fa fa-heart-o"></i>
                                   <!-- @if(Session::get('wishlist_count') > 0 )
                                        <span class="badge badge-default"> {{Session::get('wishlist_count')}} </span>
                                    @endif -->
                                    <span class="badge badge-default"> {{Helpers::getWishlistCount()}} </span>
                                </a>
                            </li>
                            <li class="icon">
                                <a href="{{ route('compare-product') }}" title="compare">
                                    <i class="fa fa-exchange"></i>
                                </a>
                            </li>
                            <li class="dropdown dropdown-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                   data-close-others="true">
                                    @if(Session::has('Img') && Session::get('Img') != '')
                                        <img alt="" class="img-circle" src="{{ config('app.api_endpoints.backend_url') . Session::get('Img') }}">
                                    @else
                                        <img alt="" class="img-circle" src="{{ asset('public/img/default-avatar.jpg') }}">
                                    @endif
                                    <span>   {{ Session::get('name')}}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="{{ route('user-orders') }}">{{__('_header.my_orders')}}</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('shipping-addresses') }}">{{__('_header.shipping_addresses')}}</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('account-settings') }}">{{__('_header.account_settings')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            <button class="btn btn-default btn-outline-custom btn-orange">{{__('_header.logout')}}</button>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="icon">
                                <a href="{{url('login')}}">
                                   {{__('_header.login')}}
                                </a>
                            </li>
                        @endif
                        <li>
                            @if(App::isLocale('en'))
                                <a href="{{ route('locale.switch', 'ar') }}" class="">
                                    العربية
                                </a>
                            @else
                                <a href="{{ route('locale.switch', 'en') }}" class="">
                                    English
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>