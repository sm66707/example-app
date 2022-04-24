<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required','min:3','unique:posts'],
            'description' =>['required','min:10'],
            'fileUpload'=>['required','image','mimes:jpg,png,jpeg'],
        ];
    }
    public function messages()
{
    return [
        'title.required' => 'the title is  required',
        'title.min' => 'the title minimum length is 3 ',
        'title.description' => 'the description is  required',
        'description.min' => 'the description minimum length is 10 ',
    ];
}
}
