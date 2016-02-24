<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Trade;

class TradeRequest extends Request
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
            'amount' => 'required|min:1|integer|max:'.Trade::remainStocks(),
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        if(\App::getLocale()=='zh'){
            return [
                'title.min' => '标题最少三个字',
                'title.required'  => '请填写决策的标题',
                'body.required'  => '请填写决策的描述',
                'department_list.required'  => '请至少选择一个部门',
                'skill_list.required'  => '请至少选择一个所需的技能',
                'type.required'  => '请选择决策的类型',
                'min_level.required'  => '请输入参与此决策需要的最低等级',
                'min_level.max'  => '等级不要超过255',
                'min_level.min'  => '等级最低为1',
                'min_level.integer'  => '等级请输入整数',
                'min_vote.required'  => '请输入参与此决策需要的最少投票权',
                'min_vote.max'  => '投票权权不要超过10m',
                'min_vote.min'  => '投票权权最低为1',
                'min_vote.integer'  => '投票权请输入整数',

            ];
        }else{
            return [];
        }

    }
}
