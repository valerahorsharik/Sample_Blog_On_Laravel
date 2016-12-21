<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserData extends FormRequest
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
            'name'=>'min:3|max:255|regex:~^[a-zA-Z]+$~',
            'surname'=>'min:3|max:255|regex:~^[a-zA-Z]+$~',
            'email'=>'min:7|max:255|email|unique:users',
        ];
    }
}
