<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function messages()
    {
        if(\App::getLocale()=='zh'){
            return [
                'email.unique' => '邮箱已被注册',
                'password.required'  => '请填写密码',
            ];
        }else{
            return [];
        }
    }
}
