<?php

namespace App\Http\Requests;

use App\Exceptions\CustomException;
use Illuminate\Foundation\Http\FormRequest;

class DestroyArticle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('delete', $this->article);
    }

    public function failedAuthorization()
    {
        throw new CustomException('forbidden');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
