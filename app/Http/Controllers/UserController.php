<?php

namespace App\Http\Controllers;
use App\Classes\Modules\Forms;
use App\Http\Controllers\ParentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Lang;
use App\Classes\Modules\Users;
use App\Classes\Modules\ShippingAddresses;
use App\Classes\Modules\Cities;

class UserController extends ParentController
{
    function __construct()
    {
        parent::__construct();
    }

    public function register()
    {
        if(\Session::get('loggedIn') == true) {
            return Redirect::route('home');
        }

        return view('user.register');
    }

    public function postRegister(Request $request)
    {
        $this->setActiveLang();
        $process = Users::register([
            "email" => $request->email,
            "username" => $request->username,
            "password" => $request->password,
            "confirm_password" => $request->confirmPassword,
            "name" => $request->name,
            "mobile" => $request->mobile,
            "app_id" => 1,
            "device_token" => "asdfgh1232;lnsadn",
            "lang_id" => $this->activeLang
        ], []);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput($request->all());
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            \Session::flash('success', ['message' => $returnObject->message()]);
            return Redirect::route('register');
        }
    }

    public function confirmRegisteration(Request $request)
    {
        $this->setActiveLang();
        $process = Users::confirmRegisteration([
            "email" => $request->email,
            "app_id" => 1,
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        $return = [];
        $code = $returnObject->code();
        $errorMessages = $returnObject->errorMessages();

        if($code != 200 || !empty($errorMessages)) {
            $return = ["status" => 0, "message" => $returnObject->message(), "summary" => $errorMessages];
        }

        if($code == 200 && empty($errorMessages)) {
            //$return = ["status" => 1, "message" => $returnObject->message()];
            // show success and redirect
            \Session::flash('success', ['message' =>  $returnObject->message()]);
            return Redirect::route('home');
        }

        return view('user.confirmRegisteration', ['return' => $return]);
    }

    public function login()
    {
        $this->setActiveLang();
        if(\Session::get('loggedIn') == true) {
            return Redirect::route('home');
        }

        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $this->setActiveLang();
        $process = Users::login([
        	"email" => $request->email,
	        "password" => $request->password,
	        "app_id" => 1,
            "lang_id" => $this->activeLang
        ], [
//            'mockFile' => 'login.json'
        ]);

        $iteratorData = iterator_to_array($process);

        $returnObject = array_pop($iteratorData);
        $content = $returnObject->content();
        $content = array_pop($content);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput();
        }

        // if success send the verification code to request token api
        if($returnObject->code() == 200 && empty($returnObject->errorMessages()) && isset($content['verification_code']) && !empty($content['verification_code'])) {

            // request token
            $requestToken = Users::requestToken([
                "verification_code" => $content['verification_code'],
                "lang_id" => $this->activeLang
            ], [
//                'mockFile' => 'request-token-success.json'
            ]);

            $iteratorData = iterator_to_array($requestToken);
            $returnObject = array_pop($iteratorData);
            $content = $returnObject->content();
            $content = array_pop($content);

            if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
                \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
                return Redirect::back()->withInput();
            }

            // all done make your final request to get user profile
            if($returnObject->code() == 200 && empty($returnObject->errorMessages() && isset($content['access_token']))) {
                Session::put('accessToken', $content['access_token']);
                Session::put('loggedIn', true);

                // fetch user data
                $this->getUserProfile();

                // show success and redirect
                \Session::flash('success', ['message' => __('messages.login_success')]);
                return Redirect::route('home');
            }
        }
    }

    public function logout()
    {
        $this->setActiveLang();
        if(Session::has('accessToken')) {
            $process = Users::logout([
                "access_token" => Session::get('accessToken'),
                "lang_id" => $this->activeLang
            ]);

            $iteratorData = iterator_to_array($process);
            $returnObject = array_pop($iteratorData);

            if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
                \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
                return Redirect::route('home');
            }

            if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {

                // remove session data
                Session::forget('accessToken');
                Session::forget('loggedIn');
                Session::forget('id');
                Session::forget('email');
                Session::forget('username');
                Session::forget('mobile');
                Session::forget('name');
                Session::forget('cart_count');
                Session::forget('wishlist_count');
                Session::forget('is_subscribed');

                // show success
                \Session::flash('success', ['message' => __('messages.logout_success')]);
                return Redirect::route('home');
            }
        }
    }

    public function checkEmail()
    {
        $this->setActiveLang();
        if(\Session::get('loggedIn') == true) {
            return Redirect::route('home');
        }

        return view('user.checkEmail');
    }

    public function postCheckEmail(Request $request)
    {
        $this->setActiveLang();
        // check email
        $process = Users::checkEmail([
            "email" => $request->email,
            "app_id" => 1,
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput();
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            // show success and redirect
            //\Session::flash('success', ['message' => $returnObject->message()]);
            \Session::put("resetEmail", $request->email);
            return Redirect::route('reset-password');
        }
    }

    public function resetPassword()
    {
        $this->setActiveLang();
        if(\Session::get('loggedIn') == true) {
            return Redirect::route('home');
        }

        if(!\Session::get('resetEmail') || \Session::get('resetEmail') == "") {
            return Redirect::route('check-email');
        }

        return view('user.resetPassword');
    }

    public function postResetPassword(Request $request)
    {
        $this->setActiveLang();
        // check email
        $process = Users::resetPassword([
            "email" => \Session::get('resetEmail'),
            "app_id" => 1,
            "new_password" => $request->password,
            "confirm_password" => $request->confirm_password,
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput();
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            // show success and redirect
            \Session::flash('success', ['message' => $returnObject->message()]);
            return Redirect::route('login');
        }
    }

    public function userProfile()
    {
        $this->setActiveLang();
        if(\Session::get('loggedIn')) {
            $this->getUserProfile();
        }
    }

    public function userOrders()
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $process = Users::userOrders([
            'access_token' => \Session::get('accessToken'),
            "lang_id" => $this->activeLang
        ]);
        $orders = iterator_to_array($process);

        return view('user.userOrders', ['orders' => $orders]);
    }

    public function shippingAddresses()
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $process = ShippingAddresses::getAll(
            ["lang_id" => $this->activeLang],
            ['access_token' => \Session::get('accessToken')]);

        $addresses = iterator_to_array($process);

        return view('user.shippingAddresses', ['addresses' => $addresses]);
    }

    public function addShipping()
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $regions   = \Helpers::getRegions();
        $cities    = \Helpers::getCities();
        $countries = \Helpers::getCountries();

        return view('user.addShippingAddress',[
            'countries' => $countries,
            'cities'    => $cities,
            'regions'   => $regions
        ]);
    }

    public function PostAddShipping(Request $request)
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $process = ShippingAddresses::add([
            "access_token" => \Session::get('accessToken'),
            "country_id" => $request->country_id,
            "city_id" => $request->city_id,
            "region_id" => $request->region_id,
            "postal_code" => $request->postal_code,
            "details" => $request->details,
            "is_main" => ($request->is_main=="on"?1:0),
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput();
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            // show success and redirect
            \Session::flash('success', ['message' => __('messages.add_shipping_success')]);
            return Redirect::route('shipping-addresses');
        }
    }

    public function editShipping($id)
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        if(!$id) {
            return response()
                ->view('errors.404');
        }

        $regions   = \Helpers::getRegions();
        $cities    = \Helpers::getCities();
        $countries = \Helpers::getCountries();

        $process = ShippingAddresses::get(["lang_id" => $this->activeLang], ['address_id' => $id, 'access_token' => \Session::get('accessToken')]);

        $address = iterator_to_array($process);
        $address = array_pop($address);

        if(!$address) {
            return response()
                ->view('errors.404');
        }


        return view('user.editShippingAddress', [
            'address'   => $address,
            'countries' => $countries,
            'cities'    => $cities,
            'regions'   => $regions
        ]);
    }

    public function updateShipping(Request$request, $id)
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $process = ShippingAddresses::edit([
            "access_token" => \Session::get('accessToken'),
            "address_id" => $id,
            "country_id" => $request->country_id,
            "city_id" => $request->city_id,
            "region_id" => $request->region_id,
            "postal_code" => $request->postal_code,
            "details" => $request->details,
            "is_main" => ($request->is_main=="on"?1:0),
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput();
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            // show success and redirect
            \Session::flash('success', ['message' => __('messages.edit_shipping_success')]);
            return Redirect::route('shipping-addresses');
        }
    }

    public function deleteShipping(Request $request)
    {
        $this->setActiveLang();
        if($request->ajax()) {

            if (!\Session::get('loggedIn')) {
                return json_encode(["status" => 0, "message" => __("messages.auth_required"), "errors" => []], true);
            }

            $fields = [];

            if (!isset($request->item_id)) {
                array_push($fields, "item_id missing");
            }

            if (count($fields)) {
                return json_encode(["status" => 0, "message" => "Missing fields", "errors" => $fields], true);
            }

            $process = ShippingAddresses::delete([
                "access_token" => \Session::get('accessToken'),
                "address_id" => $request->item_id,
                "lang_id" => $this->activeLang
            ]);

            $addToWishArray = iterator_to_array($process);
            $returnObject = array_pop($addToWishArray);

            if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
                return json_encode(["status" => 0, "message" => $returnObject->message(), "errors" => $returnObject->errorMessages()], true);
            }

            return json_encode(["status" => 1, "message" => "Shipping address deleted successfully!"]);
        }
    }

    public function setMainShipping(Request $request)
    {
        $this->setActiveLang();
        if($request->ajax()) {

            if (!\Session::get('loggedIn')) {
                return json_encode(["status" => 0, "message" => __("messages.auth_required"), "errors" => []], true);
            }

            $fields = [];

            if (!isset($request->item_id)) {
                array_push($fields, "item_id missing");
            }

            if (count($fields)) {
                return json_encode(["status" => 0, "message" => "Missing fields", "errors" => $fields], true);
            }

            $process = ShippingAddresses::setMain([
                "access_token" => \Session::get('accessToken'),
                "address_id" => $request->item_id,
                "lang_id" => $this->activeLang,
            ]);

            $addToWishArray = iterator_to_array($process);
            $returnObject = array_pop($addToWishArray);

            if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
                return json_encode(["status" => 0, "message" => $returnObject->message(), "errors" => $returnObject->errorMessages()], true);
            }

            return json_encode(["status" => 1, "message" => "Set main shipping address!"]);
        }
    }

    public function accountSettings()
    {
        // dd(\Session::get('Img'));
        $this->setActiveLang();
        $this->getUserProfile();

        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $regions   = \Helpers::getRegions();
        $cities    = \Helpers::getCities();
        $countries = \Helpers::getCountries();

        return view('user.accountSettings',[
            'countries'  => $countries,
            'cities'     => $cities,
            'regions'    => $regions
        ]);
    }

    public function getRegionCities(Request $request)
    {
        $this->setActiveLang();
        $region_id = $request->region_id;
        $response['content'] = [];

        if(isset($region_id) && is_integer((int)$region_id))
        {
            // dd($region_id);
            $cities = Cities::getByRegion($region_id, $this->activeLang);
            $cities = iterator_to_array($cities);

            $response['content'] = $cities;
        }

        return json_encode($response);
    }

    public function postAccountSettings(Request $request)
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $process = Users::editUserProfile([
            "access_token" => Session::get('accessToken'),
            "name" => $request->name,
            "mobile" => $request->mobile,
            "mail" => $request->email,
            "birthdate" => strtotime($request->birthdate),
            "country_id" => $request->country_id,
            "city_id" => $request->city_id,
            "region_id" => $request->region_id,
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput();
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            $subscribe = ($request->subscribe === 'on')?true:false;
            $user_already_subscribed = \Helpers::userAlreadySubscribed();

            if($subscribe && !$user_already_subscribed)
            {
                Forms::newsletter([
                    'application_id' => 1,
                    'mail'           => $request->email
                ]);
            }
            elseif(!$subscribe && $user_already_subscribed)
            {
                Forms::newsletterUnsubscribe([
                    'access_token' => \Session::get('accessToken')
                ]);
            }

            // show success and redirect
            \Session::flash('success', ['message' => __('messages.password_changed')]);
            $this->getUserProfile();
            return Redirect::route('account-settings');
        }
    }

    public function changePassword()
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        return view('user.changePassword');
    }

    public function PostChangePassword(Request $request)
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $process = Users::changePassword([
            "access_token" => Session::get('accessToken'),
            "password" => $request->password,
	        "new_password" => $request->new_password,
            "confirm_password" => $request->confirm_password,
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput();
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            // show success and redirect
            \Session::flash('success', ['message' => __('messages.password_changed')]);
            return Redirect::route('change-password');
        }
    }

    public function getUserProfile()
    {
        $this->setActiveLang();
        $process = Users::userProfile([
            "access_token" => \Session::get('accessToken'),
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        $code = $returnObject->code();
        $content = $returnObject->content();
        $contentArray = array_pop($content);

        if($code == 200 && empty($errorMessages)) {
            foreach ($contentArray as $k => $v) {
                \Session::put($k, $v);
            }
        }
    }

    public function changeProfileImage(Request $request)
    {
        $this->setActiveLang();
        
        if(!isset($_FILES['profile_img']['name']) || (isset($_FILES['profile_img']['name']) && !strlen($_FILES['profile_img']['name']))) {
            \Session::flash('error', ['message' => __('messages.must_upload_certificate')]);
            return redirect('account-settings');
        }

        $extension = pathinfo($_FILES['profile_img']['name'], PATHINFO_EXTENSION);

        if(!in_array($extension, ["png", "jpg", "jpeg", "JPG", "JPEG", "PNG", "gif"])) {
            \Session::flash('error', ['message' => __('messages.invalid_img_extension')]);
            return redirect('account-settings');
        }

        $profile_image = \Helpers::uploadFile(public_path('uploads'), 'profile_img', $request);

        $process = Users::changeProfileImage([
            'profile_image' => 'data:image/'.$extension.';base64,'.base64_encode(file_get_contents(public_path('uploads/'.$profile_image))),
            'access_token' => \Session::get('accessToken')
        ]);

        $iterator_data = iterator_to_array($process);
        $content_array = array_pop($iterator_data);
        \Session::forget('Img');
        \Session::put('Img', $content_array['Img']);

        return redirect()->route('account-settings');
    }

    public function purchaseProve($id){
        return view('user.addPurchaseProve', [
            'order_id'         => $id]);
    }

    public function addPurchaseProve(Request $request)
    {
        $this->setActiveLang();

        if(!isset($_FILES['payment_receipt']['name']) || (isset($_FILES['payment_receipt']['name']) && !strlen($_FILES['payment_receipt']['name']))) {
            \Session::flash('error', ['message' => __('messages.must_upload_certificate')]);
            return redirect('account-settings');
        }

        $extension = pathinfo($_FILES['payment_receipt']['name'], PATHINFO_EXTENSION);

        if(!in_array($extension, ["png", "jpg", "jpeg", "JPG", "JPEG", "PNG", "gif"])) {
            \Session::flash('error', ['message' => __('messages.invalid_img_extension')]);
            return redirect('account-settings');
        }

        $profile_image = \Helpers::uploadFile(public_path('uploads'), 'payment_receipt', $request);

        $process = Users::addPurchaseProve([
            'payment_receipt' => 'data:image/'.$extension.';base64,'.base64_encode(file_get_contents(public_path('uploads/'.$profile_image))),
            'access_token' => \Session::get('accessToken'),
            'order_id' => $_POST["order_id"]
        ]);

        $iterator_data = iterator_to_array($process);
        $content_array = array_pop($iterator_data);


        return redirect()->route('user-orders');
    }
}