<?php
/**
 * Created by PhpStorm.
 * User: Ash
 * Date: 11/6/2017
 * Time: 11:03 AM
 */

namespace App\Http\Middleware;


use App\Http\Controllers\UserController;

class GetCartCount
{
    public function handle($request, \Closure $next)
    {
        $response = $next($request);

        if(\Session::has('accessToken'))
        {
            $user_controller = new UserController();
            $user_controller->getUserProfile();
        }

        return $response;
    }
}