<?php

namespace App\Http\Controllers;

use App\Service\JwtService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Input;

class HomeController
{
    public function index()
    {
        $user = Socialite::driver('google')->with(['expiresIn' => 'google'])->stateless()->user();

        return view('welcome', ['user' => $user->token]);
    }
    public function getTokenData(Request $request,JwtService $jwtService)
    {
        return response()->json($jwtService->parseToken());
    }
}