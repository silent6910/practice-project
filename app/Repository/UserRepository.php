<?php


namespace App\Repository;

use App\Model\User;

class UserRepository
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function socialiteUser(string $providerId, string $provider, string $email, ?string $name)
    {
        return $this->model->firstOrCreate(
            [
                'email' => $email,
                'name' => $name,
                'provider_id' => $providerId,
                'provider' => $provider
            ]
        );
    }

    public function findSocialiteUser(string $providerId, string $provider)
    {
        return $this->model
            ->where(['provider_id' => $providerId, 'provider' => $provider])
            ->first();
    }

}