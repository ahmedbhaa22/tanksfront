{{--<div class="alert alert-danger alert-dismissable">--}}
    {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
    {{--<strong>تحذير! </strong>  لم يتم تفعيل الحساب لديك :--}}
    {{--<a href="" class="alert-link"> ارسال الرابط مرة اخرى </a> أو--}}
    {{--<a href="account-settings-ar.html" class="alert-link">اضغط لتعديل البريد الالكترونى</a>.--}}
{{--</div>--}}

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span>{{Session::get('success')['message']}}</span>
    </div>
@endif