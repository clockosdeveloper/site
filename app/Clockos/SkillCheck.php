<?php
/**
 * Created by PhpStorm.
 * User: YELLOVE
 * Date: 12/31/2015
 * Time: 2:03 PM
 */

namespace Clockos;


class SkillCheck
{
    public function check($check)
    {

        //用户的技能与任务需要的技能一致

        $skills = $check->skills;                       //任务所需的技能

        $user_skills = \Auth::user()->skills;           //用户擅长的技能

        $contain = false;                               //用户是擅长的技能与此任务所需技能重叠的数目

        foreach($user_skills as $item){
            foreach($skills as $skill){
                if(strpos($item->fullname,$skill->fullname)!==false){
                    $contain = true;
                    break 2;
                }
            }
        }

        return $contain;
    }
}