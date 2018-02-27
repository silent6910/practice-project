<?php


namespace App\Service;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtService
{
    public function authenticate($userData)
    {
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::fromUser($userData)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return $token;
    }
    public function parseToken()
    {
        return JWTAuth::getToken();
    }

}