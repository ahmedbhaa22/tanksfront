<div class="col-md-3 col-sm-5 col-xs-12 account-info-div">
    <div class="account-side-bar bordred-account-div">
        <div class="account-info">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <form id="change_profile_image_form" role="form" enctype="multipart/form-data" method="post" action="{{ route('change-profile-image') }}">
                        {{ csrf_field() }}
                        <input type="file" id="profile_img_input" name="profile_img" style="display: none" onchange="readURL(this)">
                        @if(Session::has('Img') && Session::get('Img') != '')
                            <a id="change_profile" href="#">
                                <img class="img-circle full-width account-img" src="{{ config('app.api_endpoints.backend_url') . Session::get('Img') }}" />
                            </a>
                        @else
                        <a id="change_profile" href="#">
                            <img class="img-circle full-width account-img" src="{{ asset('public/img/default-avatar.jpg') }}" />
                        </a>
                        @endif
                    </form>
                </div>
            </div>
            <h3 class="uppercase col-md-12 text-center">{{ Session::get('name') }}</h3>
            <p class="col-md-12">
                <a class="text-center" href="mailto:{{ Session::get('email') }}">{{ Session::get('email') }}</a></p>
        </div>
        <a href="{{ route('user-orders') }}" class="{{ Request::is("user-orders")?'active':'' }}"><i class="fa fa-shopping-bag col-md-2 col-xs-2"></i>{{__('_user_shipping_addresses.my_orders')}}</a>
        <a href="{{ route('shipping-addresses') }}" class="{{ Request::is("shipping-addresses")?'active':'' }}"><i class="fa fa-map-marker col-md-2 col-xs-2"></i>{{__('_user_shipping_addresses.shipping_addresses')}}</a>
        <a href="{{ route('account-settings') }}" class="{{ Request::is("account-settings")?'active':'' }}"><i class="fa fa-gear col-md-2 col-xs-2"></i>{{__('_user_shipping_addresses.settings')}}</a>
        <a style="padding-top: 10px;color: black;" href="{{ route('logout') }}" class="btn form-submit-btn btn-block-white uppercase col-xs-8 col-xs-offset-2 no-padding">{{__('_user_shipping_addresses.logout')}}</a>
    </div>
</div>
<script type="text/javascript">
$('#change_profile').on('click', function()
{
   $('#profile_img_input').trigger('click');
});

function readURL(input)
{
    if(input.files && input.files[0])
    {
        var reader = new FileReader();

        reader.onload = function(e)
        {
            $('.img-circle').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);

        $('#change_profile_image_form').submit();
    }
}
</script>