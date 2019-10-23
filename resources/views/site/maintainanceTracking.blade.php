@extends('template')

@section('title', "Maintainance Tracking")

@section('content')
    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('maintainance-tracking') }}

            <div class="container">

                <h3 class="main-title uppercase text-center">
                    {{__('_site_maintenance_track.track')}}
                </h3>
                {{--<div class="alert alert-danger alert-dismissable">--}}
                    {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
                    {{--<strong>تحذير! </strong> يوجد خطأ--}}
                {{--</div>--}}
                <form class="bordered col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="form-group  float-label-control">
                        <label for="maintenance-code">{{__('_site_maintenance_track.code')}}</label>
                        <span class="error-line text-danger">{{__('_site_maintenance_track.required')}}</span>
                        <input type="number" class="form-control" id="maintenance-code">
                    </div>
                    <button type="submit" class="btn form-submit-btn btn-outline-custom btn-blue col-xs-12">{{__('_site_maintenance_track.confirm')}}</button>
                </form>
                <div class="col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1">
                    <p class="text-center"><a href="{{url('maintainance')}}">{{__('_site_maintenance_track.more')}}</a></p>
                </div>

                <div class="clearfix"></div>
                <hr/>
                <div class=" clearfix">
                    <div class="col-md-2 col-sm-3 col-xs-12"><img class="full-width  centered-and-cropped" src="{{  asset('public/img/gallery-leesburg-sy-01.jpg') }}"></div>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <h4 class="uppercase">صيانة الخزان الافقي رقم 1001</h4>
                        <div class="clearfix"></div>
                        لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور
                        أنكايديديونتيوت لابوري ات دولار ماجنا أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد
                        أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات . ديواس
                        أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت
                        نيولا باراياتيور. أيكسسيبتيور ساينت أوككايكات كيوبايداتات نون بروايدينت ,سيونت ان كيولبا
                        كيو أوفيسيا ديسيريونتموليت انيم أيدي ايست لابوريوم
                    </div>
                    <div class="timeline-container">
                        <ul class="timeline timeline-horizontal">
                            <li class="timeline-item">
                                <div class="timeline-badge gray"><i class="glyphicon glyphicon-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{__('_site_maintenance_track.release_date')}}</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>منذ 11 ساعة</small></p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge gray"><i class="glyphicon glyphicon-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{__('_site_maintenance_track.confirm_date')}}</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> منذ 11 ساعة</small></p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge gray"><i class="glyphicon glyphicon-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{__('_site_maintenance_track.delivered')}}</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> منذ 11 ساعة</small></p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge danger"><i class="glyphicon glyphicon-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{__('_site_maintenance_track.canceled')}}</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> منذ 11 ساعة</small></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection