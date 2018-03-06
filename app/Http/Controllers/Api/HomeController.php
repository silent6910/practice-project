<?php

namespace App\Http\Controllers\Api;

use App\Service\JwtService;

class HomeController extends Controller
{
    public function getTokenData(JwtService $jwtService)
    {
        return response()->json($jwtService->parseToken());
    }
}