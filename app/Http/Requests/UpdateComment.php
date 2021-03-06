<?php

namespace App\Http\Requests;

use App\Traits\ValidationResponseTrait;
use Illuminate\Foundation\Http\FormRequest;


class UpdateComment extends FormRequest
{
    use ValidationResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->article, $this->comment);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => ['required', 'string', 'max:1000']
        ];
    }
}
