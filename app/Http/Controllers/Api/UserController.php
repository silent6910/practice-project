<?php


namespace App\Http\Controllers\Api;


class UserController extends Controller
{
    public function getUserData()
    {
        return responseJson(['email' => auth()->user()->email, 'name' => auth()->user()->name]);
    }

}