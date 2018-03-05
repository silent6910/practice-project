<?php


namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class LoginController
{
    /**
     * Redirect the user to the provider authentication page.
     *
     * @param $provider
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $exception) {
            abort(404, 'Unauthorized action.');
        }

    }
}