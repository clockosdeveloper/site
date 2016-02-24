<?php

namespace Clockos;

use App;

class CheckedOrNot{

    static public function change($number)
    {
        return $number?'checked':'';
    }

    static public function setting($setting)
    {
        $user_setting = \Auth::user()->settings()->first()->$setting;

        return self::change($user_setting);
    }

}