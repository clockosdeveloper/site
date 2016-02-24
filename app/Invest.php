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
}
