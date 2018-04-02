<?php


namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\CustomException;

trait ValidationResponseTrait
{
    public function failedAuthorization()
    {
        throw new CustomException('forbidden');
    }

    protected function failedValidation(Validator $validator)
    {
        throw new CustomException('validate_failed');
    }
}