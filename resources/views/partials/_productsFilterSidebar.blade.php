<div class="col-md-3 col-sm-4 filters-section no-padding">
    <button type="button" class="btn" data-toggle="collapse" data-target="#filter-sec">{{__('_store_shopping_center.filter')}}</button>
    <div id="filter-sec" class="collapse">
        <form method="GET" id="filter-form">
            <h4 class="uppercase text-primary">{{__('_store_shopping_center.filter')}}</h4>
            <div class="col-sm-12 col-xs-6 no-padding">
                <p><b class="col-xs-12 no-padding gap15">{{__('_store_shopping_center.manufacturers')}}</b></p>

                @if($manufacturersList)
                    @php $checkedManfs = request('filterManf'); @endphp
                    @foreach($manufacturersList as $key => $m)
                        <div class="row">
                            <div class="col-sm-2 col-xs-3">
                                <input type="checkbox" id="m{{$key}}" {{ (!empty($checkedManfs)?(in_array($m['id'], $checkedManfs)?"checked":""):"") }}  class="filter-manufacturer" name="filterManf[]" value="{{$m['id']}}">
                                <label for="m{{$key}}"></label>
                            </div>
                            <div class="col-sm-10 col-xs-9">
                                <p class="">{{$m['name']}} <span class="badge">{{$m['items_count']}}</span></p>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="col-sm-12 col-xs-6 no-padding">
            <p><b class="col-xs-12 no-padding gap15">{{__('_store_shopping_center.categories')}}</b></p>

            <div class="row">
                <div class="col-sm-2 col-xs-3">
                    <input type="checkbox" id="c0" class="filter-category" name="" value="">
                    <label for="c0"></label>
                </div>
                <div class="col-sm-10 col-xs-9">
                    <p class="">{{__('_store_shopping_center.all')}}<span class="badge">{{$allCategoriesProductCount}}</span></p>
                </div>
            </div>

            @if($categoriesList)
                @php $checkedCats = request('filterCategory'); @endphp
                    @foreach($categoriesList as $key => $cat)
                        <div class="row">
                            <div class="col-sm-2 col-xs-3">
                                <input type="checkbox" id="c{{$key+1}}" {{ (!empty($checkedCats)?(in_array($cat['id'], $checkedCats)?"checked":""):"") }} class="filter-category sub-categories" name="filterCategory[]" value="{{$cat['id']}}">
                                <label for="c{{$key+1}}"></label>
                            </div>
                            <div class="col-sm-10 col-xs-9">
                                <p class="">{{$cat['name']}} <span class="badge">{{$cat['items_count']}}</span></p>
                            </div>
                        </div>
                @endforeach
            @endif

        </div>
        </form>
    </div>
</div>
