<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SkillRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user =\Auth::user();

        $level = $user->level;  //用户的等级

        $count = $user->skills()->count();  //用户拥有的技能数

        if($count>0){
            if(($count<2)AND($level>4)){    //若用户等级大于4且值拥有一个技能
                return true;
            }

            return false;

        }else{
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subskill' => 'required'
        ];
    }
}
