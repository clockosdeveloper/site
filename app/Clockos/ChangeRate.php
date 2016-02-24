<?php

namespace Clockos;

use App;
use Illuminate\Support\Facades\Redis;


class ChangeRate{

    static private function rate()
    {
        $rate = Redis::get('exchange_rate_usd_cny');

        if(!$rate){
            return 6.4476;
        }

        return $rate;
    }

    static public function toRmb($price)
    {

        if(App::getLocale()=='zh'){
            $price = $price*self::rate();
        }

        return round($price,2);
    }

    static public function toUsd($price)
    {

        if(App::getLocale()=='zh'){
            $price = $price/self::rate();
        }

        return $price;
    }


}