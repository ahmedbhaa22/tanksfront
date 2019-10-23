@php $footer = Helpers::getFooter(); @endphp
<div class="bottom-footer">
        <div class="container">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-xs-4 no-padding">
                        <img src="{{ asset('public/img/logo.png') }}" class="full-width" />
                    </div>
                </div>
                <div class="col-xs-12 no-padding">
                    <p>
                        {{$footer['name']}}
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6  contact-footer-section">
                <b class="uppercase">{{__('_footer.contact_us')}}</b>
                <hr/>
                @foreach($footer['emails'] as $email)
                    <div>
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:{{$email}}">{{$email}}</a>
                    </div>
                @endforeach
                @foreach($footer['mobiles'] as $mobile)
                    <div>
                        <i class="fa fa-phone"></i>
                        <a href="tel:{{$mobile}}">{{$mobile}}</a>
                    </div>
                @endforeach
                @foreach($footer['addresses'] as $address)
                    <div>
                        <i class="fa fa-map-marker"></i>{{$address}}
                    </div>
                @endforeach
                @foreach($footer['faxes'] as $fax)
                    <div>
                        <i class="fa fa-fax"></i> {{$fax}}
                    </div>
                @endforeach
            </div>
            <div class="col-md-4 col-sm-6  links-footer-section">
                <b class="uppercase">{{__('_footer.links')}}</b>
                <hr/>

                {{-- join us --}}
                {{-- <div class="col-md-6">
                    <a href="{{ url('careers') }}">{{__('_footer.join_us')}}</a>
                </div> --}}
                {{-- end join us --}}

                {{-- faq --}}
                {{-- <div class="col-md-6">
                    <a href="{{ url('faq') }}">{{__('_footer.faq')}}</a>
                </div> --}}
                {{-- end faq --}}

                {{-- terms --}}
                {{-- <div class="col-md-6">
                    <a href="{{ url('terms-conditions') }}">{{__('_footer.terms')}}</a>
                </div> --}}
                {{-- end terms --}}

                {{--<div class="col-md-6">--}}
                    {{--<a href="{{url('maintainance')}}">{{__('_footer.maintenance')}}</a>--}}
                {{--</div>--}}

                {{-- site map --}}
                {{-- <div class="col-md-6">
                    <a href="#">{{__('_footer.site_map')}}</a>
                </div> --}}
                {{-- end site map --}}
                
                {{-- rss --}}
                {{-- <div class="col-md-6">
                    <a href="{{url('rss')}}">{{__('_footer.rss')}}</a>
                </div> --}}
                {{-- end rss --}}

                {{-- brochures --}}
                {{-- <div class="col-md-6">
                    <a href="{{ url('brochures') }}">{{__('_footer.brochures')}}</a>
                </div> --}}
                {{-- end brochures --}}
                <div class="col-md-6">
                    <a href="{{ url('branches') }}">{{__('_footer.branches')}}</a>
                </div>

            </div>
            <div class="clearfix"></div>
            <hr/>
        </div>

        <div class="container">
            <div class="col-md-8">
                {{__('_footer.copy_right')}} © {{date('Y')}}
                <a href="{{ url('/') }}">{{__('_footer.arabian_tanks')}} - </a>{{__('_footer.all_rights')}}
            </div>
            <div class="col-md-4 no-padding">
                    <span>
          						<a href="#" class=""><i class="fa fa-facebook-square"></i></a>
          						<a href="#" class=""><i class="fa fa-twitter-square "></i></a>
          						<a href="#" class=" "><i class="fa fa-instagram"></i></a>
          						<a href="#" class=""><i class="fa fa-linkedin"></i></a>
          					</span>
            </div>
        </div>
    </div>