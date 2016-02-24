<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OutcomeRequest extends Request
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
            'title' => 'required|min:3',
            'body'  => 'required',
            'type' => 'required',
            'provider' => 'required',
            'amount' => 'required|min:1|max:10000000|integer',
            'price' => 'required|min:0|numeric',
            'start' => 'date|after:2011-12-31',
            'end' => 'date|after:start',
        ];
    }
}
