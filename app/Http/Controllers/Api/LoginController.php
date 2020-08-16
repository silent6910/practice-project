<?php

namespace App\Http\Controllers\Api;

use App\Repository\UserRepository;
use App\Service\JwtService;
use http\Client\Request;
use Laravel\Socialite\Facades\Socialite;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class SubrectangleQueries
 * @package App\Http\Controllers\Api
 */
class SubrectangleQueries {
    /**
     * @param Integer[][] $rectangle
     */



}

/**
 * Your SubrectangleQueries object will be instantiated and called as such:
 * $obj = SubrectangleQueries($rectangle);
 * $obj->updateSubrectangle($row1, $col1, $row2, $col2, $newValue);
 * $ret_2 = $obj->getValue($row, $col);
 */

class LoginController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }


    /**
     * @param $provider
     * @param UserRepository $userRepository
     * @param JwtService $jwtService
     * @return array
     * @throws \App\Exceptions\CustomException
     */
    public function handleProviderCallback($provider, UserRepository $userRepository, JwtService $jwtService)
    {

        //laravel default code
//        $user = Socialite::driver($provider)->stateless()->user();

        $user = Socialite::driver($provider)->userFromToken(request()->bearerToken());

        $user = $userRepository->socialiteUser($user->getId(), $provider, $user->getEmail(), $user->getName());

        $jwtToken = $jwtService->authenticate($user);

        return responseJSON(['token' => $jwtToken]);
    }

    /**
     * @param JwtService $jwtService
     * @return array
     */
    public function logout(JwtService $jwtService)
    {
        $jwtService->invalidateToken();

        return responseJSON();
    }
}