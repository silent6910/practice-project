<?php

namespace App\Http\Requests;

use App\Exceptions\CustomException;
use App\Model\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => ['required', Rule::in(\ArticleType::getConstants()),],
            'title' => ['required', 'string', 'max:300'],
            'content' => ['required', 'string',]
        ];
    }

    /**
     * verify that user  enough permission
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @param User $user
     * @return void
     * @throws CustomException
     */
    public function withValidator($validator, User $user)
    {
        $articlePermission = \ArticleType::getPermission();
        if (!isset($articlePermission[$this->input('type')])) {
            return;
        }
        if (!$user->hasPermissionTo($articlePermission[$this->input('type')])) {
            throw new CustomException('', config('errorCode.unauthorized'));
        }

    }
}
