<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

class Decision extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'type',
        'state',
        'min_level',
        'completed',
        'amount',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function($decision){

            $carbon = new Carbon;

            $overtime = $carbon->parse($decision->completed)->addHours(8);

            $event_name = 'decision_over_'.$decision->id;

            $query = "CREATE DEFINER=`root`@`localhost` EVENT `$event_name` ON SCHEDULE AT '$overtime' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE `clockosdeveloper`.`decisions` SET `state` = 4 WHERE `decisions`.`id` = $decision->id";

            DB::connection()->getPdo()->exec($query);

        });
    }

    protected $dates = ['completed'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function departments()
    {
        return $this->belongsToMany('App\Department');
    }

    public function optionsOrder()
    {
        return $this->HasMany('App\Option')->orderBy('amount','desc');
    }

    public function options()
    {
        return $this->HasMany('App\Option');
    }

    public function votes()
    {
        return $this->HasMany('App\Vote');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill');
    }

    public function getDepartmentListAttribute()
    {
        return $this->departments->lists('id')->all();
    }

    public function getSkillListAttribute()
    {
        return $this->skills->lists('id')->all();
    }

    public function ownDecision()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public static function remainVotes()
    {
        $votes =DB::select('SELECT sum(`votes`.`amount`) as `votes` FROM `decisions` INNER JOIN `votes` WHERE `decisions`.`id` = `votes`.`decision_id` AND `votes`.`user_id` = :id AND `decisions`.`state`=3',['id' => \Auth::id()]);

        return \Auth::user()->vote-$votes[0]->votes;

    }
}
