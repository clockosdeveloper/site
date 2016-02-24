<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['sponsor_code'];

    protected $table = 'settings';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo('App\User','id');
    }
}
