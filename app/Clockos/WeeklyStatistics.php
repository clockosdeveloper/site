<?php

namespace Clockos;

use App;
use App\Status;
use App\Weekly;

class WeeklyStatistics{

    static public function record()
    {
        $status = Status::latest()->first();

        $last_week = Weekly::latest()->first();

        $mono_incr = ['stock','quests_done','members','stock_trade','invested','outcome'];

        foreach($mono_incr as $item){

            $diff = $item.'_d';

            $data[$item] = $status->$item;

            $data[$diff] = $status->$item-$last_week->$item;

            $data[($item.'_dd')] = $data[$diff]-$last_week->$diff;

        }

        $updown = ['average_price','cash_flow'];

        foreach($updown as $item){

            $diff = $item.'_d';

            $data[$item] = $status->$item;

            $data[$diff] = $status->$item-$last_week->$item;

            $data[($item.'_p')] = ($data[$diff]/$last_week->$item)*100;

        }

        Weekly::create($data);
    }

}