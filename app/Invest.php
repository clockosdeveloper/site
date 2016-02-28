<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function checker()
    {
        return $this->belongsTo('App\User','checker_id');
    }

    public static function invested()
    {
        return self::where('state',4)->sum('price');
    }
}
