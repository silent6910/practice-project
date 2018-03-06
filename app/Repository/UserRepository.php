<?php


namespace App\Repository;

use App\Model\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param string $providerId
     * @param string $provider
     * @param string $email
     * @param string $name
     * @return User $user
     */
    public function socialiteUser(string $providerId, string $provider, string $email, string $name)
    {
        return DB::transaction(function () use ($providerId, $provider, $email, $name) {
            $user = $this->model->firstOrCreate(
                [
                    'email' => $email,
                    'name' => $name,
                    'provider_id' => $providerId,
                    'provider' => $provider
                ]
            );
            $user = $this->giveDefRole($user);
            return $user;
        });

    }

    /**
     * @param User $user
     * @return User
     */
    public function giveDefRole(User $user)
    {
        return $user->assignRole(config('role.premiumRole'));
    }

}