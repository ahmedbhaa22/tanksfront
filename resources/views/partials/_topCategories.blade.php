<nav class="navbar navbar-default sec-nav">
    <div class="container">
        <ul class="nav navbar-nav">
            @if($categories)
                @foreach($categories as $cat)
                    <li class="uppercase"><a class="" href="{{ url('store/shopping-center?filterCategory[]='.$cat['id']) }}">{{ $cat['name'] }}</a></li>
                @endforeach
            @endif
        </ul>
        <ul class="nav navbar-nav">
            <li class="uppercase"><a href="{{ url('store/offers') }}" class="orange-txt">{{__('_top_categories.offers_and_more')}}</a></li>
        </ul>
    </div>
</nav>