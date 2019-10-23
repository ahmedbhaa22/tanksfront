@extends('template')

@section('title', "Faq")

@section('content')
    <div class="container-fluid no-padding page-body">
    <div class="container">

        {{ Breadcrumbs::render('faq') }}

        <div class="container">

            <h3 class="main-title uppercase">
                {{__('_site_faq.faq')}}
            </h3>
            <div class="panel-group" id="accordion">
                <div class="faqHeader">{{__('_site_faq.general')}}</div>
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <span class="col-md-1 col-xs-2 orange-txt no-padding">س</span>
                                <span class="col-md-10 col-xs-9">هل وجود حساب لى على الموقع ضروري ؟</span>
                            </a>
                            <div class="clearfix"></div>
                        </h5>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <span class="col-md-1 col-xs-2 orange-txt no-padding">ج</span>
								<span class="col-md-11 col-xs-10 no-padding">
								فقط فى حالة الشراء او طلب الصيانة .....
							</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen">
                                <span class="col-md-1 col-xs-2 orange-txt no-padding">س</span>
                                <span class="col-md-10 col-xs-9">هل وجود حساب لى على الموقع ضروري ؟</span>
                            </a>
                            <div class="clearfix"></div>
                        </h5>
                    </div>
                    <div id="collapseTen" class="panel-collapse collapse">
                        <div class="panel-body">
                            <span class="col-md-1 col-xs-2 orange-txt no-padding">ج</span>
								<span class="col-md-11 col-xs-10 no-padding">
								فقط فى حالة الشراء او طلب الصيانة .....
							</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">
                                <span class="col-md-1 col-xs-2 orange-txt no-padding">س</span>
                                <span class="col-md-10 col-xs-9">هل وجود حساب لى على الموقع ضروري ؟</span>
                            </a>
                            <div class="clearfix"></div>
                        </h5>
                    </div>
                    <div id="collapseEleven" class="panel-collapse collapse">
                        <div class="panel-body">
                            <span class="col-md-1 col-xs-2 orange-txt no-padding">ج</span>
								<span class="col-md-11 col-xs-10 no-padding">
								فقط فى حالة الشراء او طلب الصيانة .....
							</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="faqHeader">{{__('_site_faq.maintenance')}}</div>
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <span class="col-md-1 col-xs-2 orange-txt no-padding orange-txt">Q</span>
                                <span class="col-md-10 col-xs-9">هل وجود حساب لى على الموقع ضروري ؟</span>
                            </a>
                            <div class="clearfix"></div>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <span class="col-md-1 col-xs-2 orange-txt no-padding orange-txt">A</span>
								<span class="col-md-11 col-xs-10 no-padding">
								فقط فى حالة الشراء او طلب الصيانة .....
							</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThere">
                                <span class="col-md-1 col-xs-2 orange-txt no-padding">س</span>
                                <span class="col-md-10 col-xs-9">هل وجود حساب لى على الموقع ضروري ؟</span>
                            </a>
                            <div class="clearfix"></div>
                        </h5>
                    </div>
                    <div id="collapseThere" class="panel-collapse collapse">
                        <div class="panel-body">
                            <span class="col-md-1 col-xs-2 orange-txt no-padding">ج</span>
								<span class="col-md-11 col-xs-10 no-padding">
								فقط فى حالة الشراء او طلب الصيانة .....
							</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="faqHeader">{{__('_site_faq.products')}}</div>
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                <span class="col-md-1 col-xs-2 orange-txt no-padding">س</span>
                                <span class="col-md-10 col-xs-9">هل وجود حساب لى على الموقع ضروري ؟</span>
                            </a>
                            <div class="clearfix"></div>
                        </h5>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <span class="col-md-1 col-xs-2 orange-txt no-padding">ج</span>
								<span class="col-md-11 col-xs-10 no-padding">
								فقط فى حالة الشراء او طلب الصيانة .....
							</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-custom">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                <span class="col-md-1 col-xs-2 orange-txt no-padding">س</span>
                                <span class="col-md-10 col-xs-9">هل وجود حساب لى على الموقع ضروري ؟</span>
                            </a>
                            <div class="clearfix"></div>
                        </h5>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="panel-body">
                            <span class="col-md-1 col-xs-2 orange-txt no-padding">ج</span>
								<span class="col-md-11 col-xs-10 no-padding">
								فقط فى حالة الشراء او طلب الصيانة .....
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