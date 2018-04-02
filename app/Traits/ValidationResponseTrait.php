<?php


namespace App\Traits;


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