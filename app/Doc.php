<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    protected $fillable = [
        'title',
        'body',
        'entitle',
        'enbody',
        'permalink',
        'min_level',
        'keyword',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function checker()
    {
        return $this->belongsTo('App\User','checker_id');
    }

    public function departments()
    {
        return $this->belongsToMany('App\Department');
    }

    public static function number()
    {
        return self::count();
    }

    public function getDepartmentListAttribute()
    {
        return $this->departments->lists('id')->all();
    }
}
