<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Quest;

class Status extends Model
{
    protected $table = "status";


    public static function questsNum($state)
    {
        return Quest::whereIn('state',$state)->count();
    }

    public static function stocksNum($state)
    {
        return Quest::whereIn('state',$state)->sum('stock');
    }

    public static function usersNum($type)
    {
        return User::whereIn('type',$type)->count();
    }

    public static function usersSum($column)
    {
        return User::sum($column);
    }

    public static function allQuestsNum()
    {
        $quests_all = self::questsNum([0,1,2,3,4]);                 //全部任务数

        $status = ['quests_all' => $quests_all];

        self::updateStatus($status);
    }

    public static function updateStatus($column)
    {
        $newItem = Status::latest('created_at')->first()->replicate();

        foreach($column as $key => $value){
            $newItem->$key = $value;
        }

        $newItem->save();
    }
}

