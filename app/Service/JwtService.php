<?php


namespace App\Service;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtService
{

    /**
     * @param $userData
     * @return string
     */
    public function authenticate($userData)
    {
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::fromUser($userData)) {
                throw new JWTException('invalid_credentials', 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            config(['defaultStatus' => $e->getCode()]);
            return '';
        }

        return $token;
    }

    public function parseToken()
    {
        return JWTAuth::parseToken()->authenticate();
    }

    public function invalidateToken()
    {
        try {
            JWTAuth::invalidate();
        } catch (JWTException $JWTException) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    }

}