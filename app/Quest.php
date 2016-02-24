<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    //
    protected $fillable = [
        'title',
        'body',
        'published_at',
        'type',
        'difficulty',
        'stock',
        'fullname',
        'estimated',
        'min_level',
        'days',
        'completed',
    ];

    protected $dates = ['estimated', 'completed', 'published_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function executor()
    {
        return $this->belongsTo('App\User','execution_id');
    }

    public function checker()
    {
        return $this->belongsTo('App\User','checker_id');
    }

    public function final_checker()
    {
        return $this->belongsTo('App\User','final_checker_id');
    }

    public function departments()
    {
        return $this->belongsToMany('App\Department');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill');
    }

    public static function prerequisite($id)
    {
        //return $this->hasMany('App\Quest','id','prerequisite_id');
        return \DB::table('quests')
            ->join('prerequisite_quest', 'quests.id', '=', 'prerequisite_quest.prerequisite_id')
            ->where('prerequisite_quest.quest_id',$id)
            ->lists('quests.id', 'quests.title','quests.fullname');
    }

    public function quests()
    {
        return $this->belongsToMany('App\Quest','prerequisite_quest','quest_id','prerequisite_id');
    }

    public function getDepartmentListAttribute()
    {
        return $this->departments->lists('id')->all();
    }

    public function getSkillListAttribute()
    {
        return $this->skills->lists('id')->all();
    }

    public function ownQuest()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
