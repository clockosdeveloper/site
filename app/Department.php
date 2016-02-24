<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * A feature may belongs to individual departments.
     * һ������/���ܿ������ڶ������
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function quests()
    {
        return $this->belongsToMany('App\Department');
    }

    public function decisions()
    {
        return $this->belongsToMany('App\Decision');
    }

    public function docs()
    {
        return $this->belongsToMany('App\Doc');
    }
}
