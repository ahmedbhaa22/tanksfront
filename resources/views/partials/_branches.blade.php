@foreach($branches as $branch)
    <div class="branch item ">
        <div class="col-md-6 no-padding">

            @include('partials._map', ['latitude' => Helpers::getCmsKeyValueItemText($branch, "lat"), 'longitude' => Helpers::getCmsKeyValueItemText($branch, "long")])


        </div>
        <div class="col-md-6 no-padding branches-div">
            <div class="col-xs-12 no-padding">
                <div class="col-xs-11 col-xs-offset-1 ">
                    <h2 class="uppercase">
                        {{$branch['name']}}
                    </h2>
                    <div class="col-md-12 no-padding">
                        <i class="fa fa-map-marker col-md-1"></i>
                        <p class="col-md-11">{{Helpers::getCmsKeyValueItemText($branch, "address")}}</p>
                    </div>
                    <div class="col-md-12 no-padding">
                        <i class="fa fa-envelope col-md-1"></i>
                        <p class="col-md-11">
                            @foreach(Helpers::getCmsModuleGroup($branch, "email_contacts") as $key => $item)
                                @if($item[1]['parameter'] == 'name')
                                    <a href="mailto:{{$item[1]['value']}}">{{$item[1]['value']}}</a>
                                    @if(!$loop->last)
                                        <br/>
                                    @endif
                                @endif
                            @endforeach
                        </p>
                    </div>
                    <div class="col-md-12 no-padding">
                        <i class="fa fa-phone col-md-1"></i>
                        <p class="col-md-11">
                            @foreach(Helpers::getCmsModuleGroup($branch, "mobile_contacts") as $key => $item)
                                @if($item[1]['parameter'] == 'name')
                                    <a href="tel:{{$item[1]['value']}}">{{$item[1]['value']}}</a>
                                    @if(!$loop->last)
                                        <br/>
                                    @endif
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach