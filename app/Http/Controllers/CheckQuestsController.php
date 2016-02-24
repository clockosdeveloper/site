<?php

namespace App\Http\Controllers;

use App\Jobs\PublishTask;
use App\Jobs\UpdateStatus;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quest;
use App\Skill;
use Carbon\Carbon;
use App\Status;
use App\Jobs\OpenTask;
use App\User;

class CheckQuestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Quest $quest)
    {
        if(\Auth::user()->can('check_task')){
            $quests = $quest->where(['state'=>'0'])
                            ->where('min_level','<=',\Auth::user()->level)  //任务等级小于等于用户等级
                            ->paginate(30);
            return view('manage.all',compact('quests'));
        }else{
            return 'opps';
        }

    }

    public function publish($id)
    {
        if(\Auth::user()->can('check_task')){

            $priority = Quest::whereIn('state',[1,2])->max('priority');

            Quest::where('id',$id)->
                   where('state',0)->update(['state'=>1,
                           'checker_id'   => \Auth::id(),
                           'priority'     => $priority+1,
                           'published_at' => Carbon::now()]);     //审核此阶段任务的用户id

            $quest = Quest::where('id',$id)->first();

            $this->dispatch(new PublishTask($quest));

            return redirect('/quests/'.$id);

        }else{
            return 'opps';
        }

    }

    public function completion()
    {
        if(\Auth::user()->can('task_completion')){

            $quests = Quest::where('state',3)
                           ->whereNotNull('completed')
                           ->orderBy('completed','desc')
                           ->paginate(30);

            return view('manage.completion',compact('quests'));

        }else{
            return 'opps';
        }

    }

    public function isCompleted($id)
    {
        if(\Auth::user()->can('task_completion')){

            $quest = Quest::where('state',3)
                          ->whereNotNull('completed')
                          ->where('id',$id)
                          ->firstOrFail();

            $quest->state = 4;

            $quest->final_checker_id = \Auth::id();

            $quest->save();

            $job = new UpdateStatus($quest);

            $this->dispatch($job);

            flash()->success(trans('alert.check_completion'));

            return redirect('check/completion');

        }else{
            return 'opps';
        }

    }

    public function priority()
    {
        if(\Auth::user()->can('task_priority')) {

            $input = \Request::all();

            array_forget($input, 'page');

            $skills = Skill::whereHas('quests', function ($query) {
                $query->whereRaw("((`quests`.`state` = 1) OR (`quests`.`state` =2))");
            })->get();


            $quests = Quest::whereHas('skills', function ($query) use ($input) {
                $query->where($input)->whereRaw("((`quests`.`state` = 1) OR (`quests`.`state` =2))");
            })->orderBy('priority', 'asc')->get();

            return view('manage.priority', compact('quests', 'skills'));

        }

    }

    public function move()
    {
        if(\Auth::user()->can('task_priority')) {
            $input = \Request::all();

            $quest = Quest::findOrFail($input['id']);


            if($input['skill_id']==''){
                $skill = [];
            }else{
                $skill = ['skills.id' =>$input['skill_id']];
            }


            if ($input['move'] == '>') {
                $change = Quest::whereHas('skills', function ($query) use ($input, $quest, $skill) {
                    $query->whereIn('state', [1,2])->where($skill)->where('priority', '>', $quest->priority);
                });
                $priority = $change->min('priority');
                $state = $change->min('state');
            } else {
                $change = Quest::whereHas('skills', function ($query) use ($input, $quest, $skill) {
                    $query->whereIn('state', [1,2])->where($skill)->where('priority', '<', $quest->priority);
                });
                $priority = $change->max('priority');
                $state = $change->max('state');
            }

            Quest::where('priority',$priority)->update(['priority' => $quest->priority, 'state' => $quest->state]);

            Quest::where('id',$quest->id)->update(['priority' => $priority, 'state' => $state]);

            return \Redirect::back();
        }

    }

    public function open()
    {
        if(\Auth::user()->can('task_priority')) {
            $input = \Request::all();

            $quest = Quest::findOrFail($input['id']);

            if($input['skill_id']==''){
                $skill = [];
            }else{
                $skill = ['skills.id' =>$input['skill_id']];
            }

            Quest::whereHas('skills', function ($query) use ($input, $quest, $skill) {
                $query->whereIn('state', [1,2])->where($skill)->where('priority', '>', $quest->priority);
            })->update(['state'=> 1]);

            Quest::whereHas('skills', function ($query) use ($input, $quest, $skill) {
                $query->whereIn('state', [1,2])->where($skill)->where('priority', '<=', $quest->priority);
            })->update(['state'=> 2]);

            $this->dispatch(new OpenTask());

            return \Redirect::back();
        }

    }

}
