<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuestRequest extends Request
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
            'published_at' => 'date',
            'department_list' => 'required',
            'skill_list' => 'required',
            'type' => 'required',
            'difficulty' => 'required|integer|min:1|max:5',
            'stock' => 'required|min:0|max:10000000|integer',
            'min_level' => 'required|min:1|max:255|integer',
            'days' => 'required|min:1|max:1000|integer',
        ];
    }

    public function messages()
    {
        if(\App::getLocale()=='zh'){
            return [
                'title.min' => '标题最少三个字',
                'title.required'  => '请填写任务的标题',
                'body.required'  => '请填写任务的描述',
                'department_list.required'  => '请至少选择一个部门',
                'skill_list.required'  => '请至少选择一个所需的技能',
                'type.required'  => '请选择任务的类型',
                'stock.required'  => '请输入股权',
                'stock.max'  => '股权不要超过10m',
                'stock.min'  => '股权最低为0',
                'stock.integer'  => '股权请输入整数',
            ];
        }else{
            return [];
        }

    }
}
