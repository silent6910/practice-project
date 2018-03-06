<?php


namespace App\Service;

use App\Exceptions\CustomException;
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

        // attempt to verify the credentials and create a token for the user
        if (!$token = JWTAuth::fromUser($userData)) {
            throw new CustomException('invalid_credentials');
        }

        return $token;
    }

    public function parseToken()
    {
        return JWTAuth::parseToken()->authenticate();
    }

    public function invalidateToken()
    {

        JWTAuth::invalidate();

    }

}