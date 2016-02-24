<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $dates = ['start','end'];

    protected $fillable = ['start','end','type','title','body','price','amount','average','provider'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function checker()
    {
        return $this->belongsTo('App\User','checker_id');
    }
}
