@extends('template')

@section('title', "Branches")

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container">

        {{ Breadcrumbs::render('branches') }}

        <div class="col-xs-12 no-padding">
            <h4 class="main-title uppercase">
                {{__('_site_branches.branches')}}
            </h4>
            <div class='container'>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="district">{{__('_site_branches.choose_region')}}</label>

                        <select class="form-control" id="district">
                            <option value="">{{__('_site_branches.all_regions')}}</option>
                            @foreach(Helpers::getRegions() as $region)
                                <option value="{{$region['id']}}">{{$region['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div >
                    <!-- Indicators -->

                    <!-- Wrapper for slides -->
                    <div id="branches-block">



                    </div>

                </div>
            </div>

            <!-- -->
        </div>
        <div class="clearfix"></div>
    </div>
    </div>
@endsection

@section('bottom_scripts')
    <script>
        $(document).ready(function () {
            getBranches();
            $("#district").change(function () {
                getBranches();
            });
        });

        function getBranches()
        {
            $("#branches-block").html('');
            $.ajax({
                url: '{{ url('branches') }}',
                data: {region_id: $('#district').val()},
                type: "GET",
                success: function (res) {
                    if(res) {
                        $("#branches-block").html(res);
                    }
                },
                error: function () {
                    console.log("ajax error");
                }
            });
        }
    </script>

@endsection