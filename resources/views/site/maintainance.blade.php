@extends('template')

@section('title', "Maintainance")

@section('content')
    <div class="container-fluid no-padding page-body">
        <div class="container">

            {{ Breadcrumbs::render('maintainance') }}

            <div class="container">

                <h3 class="main-title uppercase text-center">
                    {{__('_site_maintenance.maintenance')}}
                </h3>
                <p>لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا
                    أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات
                    . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور.</p>
                <p>لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور أنكايديديونتيوت لابوري ات دولار ماجنا
                    أليكيوا . يوت انيم أد مينيم فينايم,كيواس نوستريد أكسير سيتاشن يللأمكو لابورأس نيسي يت أليكيوب أكس أيا كوممودو كونسيكيوات
                    . ديواس أيوتي أريري دولار إن ريبريهينديرأيت فوليوبتاتي فيلايت أيسسي كايلليوم دولار أيو فيجايت نيولا باراياتيور.</p>
                <div class="">
                    <a href="{{ url('maintainance-tracking') }}" class="btn form-submit-btn  btn-outline-custom btn-blue col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">{{__('_site_maintenance.track')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection