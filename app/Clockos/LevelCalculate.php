<?php
/**
 * Created by PhpStorm.
 * User: YELLOVE
 * Date: 1/8/2016
 * Time: 10:03 AM
 */

namespace Clockos;


class LevelCalculate
{

    public function toLevel($exp,$now)
    {

        if($exp<11){
            $level = 1;
        }elseif($exp>33162760){
            $level = 255;
        }else{
            $level = floor(pow((($exp-10)/2), 1/3));
        }

        if($level<= $now){
            $level = $now;
        }

        return $level;
    }
}