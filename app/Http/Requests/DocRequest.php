<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DocRequest extends Request
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
            'title' => 'required|min:1',
            'permalink' => 'required|alpha_dash',
            'keyword' => 'required|min:1',
            'body'  => 'required',
            'department_list' => 'required',
            'min_level' => 'required|min:1|max:255|integer',
            'lang' => 'required',
        ];
    }

    public function messages()
    {
        if(\App::getLocale()=='zh'){
            return [
                'title.min' => '标题最少1个字',
                'title.required'  => '请填写文档的标题',
                'keyword.min' => '关键字最少1个字',
                'keyword.required'  => '请填写文档的关键字',
                'body.required'  => '请填写任务的详情',
                'department_list.required'  => '请至少选择一个部门',
            ];
        }else{
            return [];
        }

    }
}
