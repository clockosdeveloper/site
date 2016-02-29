<?php

namespace App\Http\Requests;

use App\Decision;
use App\Http\Requests\Request;

class VoteRequest extends Request
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
        $remain = Decision::remainVotes();

        $vote_rule = 'required|min:1|integer|max:'.$remain;
        return [
            'option' => 'required|',
            'amount' => $vote_rule,
        ];
    }

    public function messages()
    {
        if(\App::getLocale()=='zh'){
            return [
                'option.required' => '请选择一个选项',
                'amount.min'  => '最少要投1票',
                'amount.max'  => '投的票数超过了你剩余的票数',
                'amount.integer'  => '等级请输入整数',
                'amount.required'  => '请输入票数',
            ];
        }else{
            return [];
        }

    }
}
