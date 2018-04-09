<?php

namespace App\Http\Requests;

use App\Exceptions\CustomException;
use App\Traits\ValidationResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticle extends FormRequest
{

    use ValidationResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //use laravel policy
        return $this->user()->can('update', $this->article);
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
     * @return void
     * @throws CustomException
     */
    public function withValidator($validator)
    {
        $user = auth()->user();
        $articlePermission = \ArticleType::getPermission();
        if (!isset($articlePermission[$this->input('type')])) {
            return;
        }
        if (!$user->hasPermissionTo($articlePermission[$this->input('type')])) {
            throw new  CustomException('unauthorized');
        }

    }
}
