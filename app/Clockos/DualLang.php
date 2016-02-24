<?php

namespace Clockos;

use App;

class DualLang{

    static public function lang($zh,$en)
    {

        if(!$en){
            $en = $zh;
        }elseif(!$zh){
            $zh = $en;
        }

        if(App::getLocale()=='en'){
            return $en;
        }

        return $zh;
    }

}