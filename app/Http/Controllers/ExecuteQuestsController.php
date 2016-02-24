<?php

namespace App\Http\Controllers;

use App\Events\AvailableUser;
use App\Jobs\ExecuteTask;
use Illuminate\Http\Request;

use App\Http\Requests\ExecuteRequest;
use App\Http\Controllers\Controller;
use App\Quest;
use Carbon\Carbon;
use App\User;
use Clockos\SkillCheck;

class ExecuteQuestsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('profile');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 提交预计完成的时间
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExecuteRequest $request,Carbon $carbon)
    {
        $input = $request->all();

        $quest = $this->canExecute($input['id']);

        $user = new User;

        if($quest){

            Quest::where('id',$input['id'])
                 ->update(['estimated' => $carbon->addDays($quest->days),
                           'state' => 3,
                           'execution_id' => \Auth::id()]);

            $this->dispatch(new ExecuteTask());

            return redirect('/quests/'.$input['id']);
        }
    }

    /**
     * 执行任务，填写预计完成的时间
     */
    public function show($id)
    {

        $quest = $this->canExecute($id);           //用户是否能执行此任务

        if($quest){
            return view('quest/execute',compact('quest'));
        }

        return redirect('/quests/'.$id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $quest = Quest::findOrFail($id);

        if($quest->execution_id == \Auth::id()){

            $quest->update(['completed' => Carbon::now()]);

            return redirect('/quests/'.$id);

        }else{
            dd('Opps');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function canExecute($id)
    {

        //登陆状态--ok

        //任务开放中且没有人在做

        $quest = Quest::where('state',2)        //任务开放中
                ->where('id',$id)
                ->whereNull('execution_id')->firstOrFail();

        //用户没有在执行任务

        $execution = Quest::where('execution_id',\Auth::id())
                          ->where('state',3)
                          ->first();

        $level = \Auth::user()->level < $quest->min_level;  //用户等级小于任务等级

        if($execution){
            flash()->warning(trans('alert.task_not_completed'))->important();
            return false;
        }


        $check = new SkillCheck;

        $contain = $check->check($quest);       //检查用户的技能与任务所需的技能是否一致

        if(!$contain OR $level){
            flash()->warning(trans('alert.task_not_matched'))->important();
            return false;
        }

        return $quest;
    }
}
