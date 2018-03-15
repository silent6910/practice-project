<?php

namespace App\Http\Controllers\Api;

use App\Repository\UserRepository;
use App\Service\JwtService;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{


    /**
     * @param $provider
     * @param UserRepository $userRepository
     * @param JwtService $jwtService
     * @return array
     * @throws \App\Exceptions\CustomException
     */
    public function handleProviderCallback($provider, UserRepository $userRepository, JwtService $jwtService)
    {
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