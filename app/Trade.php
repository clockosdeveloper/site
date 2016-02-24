<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = ['amount','price','average'];

    public function buyer()
    {
        return $this->belongsTo('App\User','buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo('App\User','seller_id');
    }

    public static function remainStocks()
    {
        $stock = self::where('seller_id', \Auth::id())->where('state', 0)->sum('amount');

        return \Auth::user()->stock-$stock;
    }
}
