<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['amount'];

    public $timestamps = false;

    public function decision()
    {
        return $this->belongsTo('App\Decision');
    }
}
