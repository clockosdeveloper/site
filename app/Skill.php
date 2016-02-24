<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Skill extends Model
{

    protected $fillable = ['user_id','skill_id'];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function quests()
    {
        return $this->belongsToMany('App\Quest');
    }

    public function decisions()
    {
        return $this->belongsToMany('App\Decision');
    }
}
