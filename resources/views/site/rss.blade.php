@extends('template')

@section('title', "RSS")

@section('content')
    <div class="container-fluid no-padding page-body  news-details-page">
        <div class="container">

            {{ Breadcrumbs::render('rss') }}

            <div class="container">

                <h3 class="main-title uppercase gap-left">
                    خدمة RSS للمعلومات
                </h3>
                <div class="clearfix"></div>
                <!-- <div class="col-md-4">
                    <img src="img/news.png" class="full-width" />
                </div> -->
                <div class="col-md-12">
                    <h3>ما هى خدمة الـ RSS</h3>
                    <ul id="mean" class="content">
                        <li>
                            {{__('_site_rss.details1')}}
                        </li>
                        <li>{{__('_site_rss.details2')}}</li>
                        <li>
                            {{__('_site_rss.details3')}}
                        </li>
                    </ul>
                </div>

                <div class="clearfix"></div>

                <div class="panel-group" id="accordion">
                    <div class="faqHeader"> </div>
                    <div class="panel panel-custom">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <span class="col-sm-11 col-xs-10"> الخزانات </span>
                                </a>
                                <div class="clearfix"></div>
                            </h5>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
								<span class="col-md-12 no-padding">
									محتوى
								</span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection