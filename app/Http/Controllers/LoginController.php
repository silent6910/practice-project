<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Service\JwtService;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider, UserRepository $userRepository, JwtService $jwtService)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
            $userData = [];

            $userRepository->socialiteUser($user->getId(), $provider, $user->getEmail(), $user->getName());

            $jwtToken = $jwtService->authenticate($userRepository->findSocialiteUser($user->getId(), $provider));
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }

        return $jwtToken;
    }
}