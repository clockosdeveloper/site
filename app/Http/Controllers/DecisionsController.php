<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\DecisionRequest;
use App\Http\Requests\VoteRequest;
use App\Http\Controllers\Controller;
use App\Decision;
use App\Department;
use App\Skill;
use App\Status;
use App\Option;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Vote;
use Gate;
use Clockos\SkillCheck;
use DB;

class DecisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('profile', ['except' => ['index']]);
    }


    public function index()
    {

        $input = \Request::all();

        array_forget($input, 'page');

        if(array_key_exists('level', $input)){
            $level = "`min_level`".$input['level'];
            $decisions = Decision::whereRaw($level);
        }elseif(array_key_exists('department', $input)){
            $decisions = Decision::whereHas('departments', function ($query) use ($input) {
                $query->where('fullname','LIKE','%'.$input['department'].'%');
            });
        }else{
            $decisions = Decision::where($input);
        }

        $decisions = $decisions->latest()->paginate(12);

        return view('decision.index',compact('decisions'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::lists('fullname','id');

        $status = Status::latest()->first();

        $skills = Skill::lists('fullname','id');

        return view('decision.create',compact('departments','skills','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DecisionRequest $request,Carbon $carbon,Option $options)
    {

        $input = $request->all();

        $values = array_slice($input['options'],0,10);


        foreach($values as $value){
            if(!isset($value) || trim($value)===''){
                $err_msg = trans('decision.option_title');
                break;
            }
        }

        if(isset($err_msg)) {
            dd($err_msg);
        }

        $input['completed'] = $carbon->addDays($input['days']);

        $decision = Auth::user()->decisions()->create($input);

        $decision->departments()->attach($request->input('department_list'));

        $decision->skills()->attach($request->input('skill_list'));

        foreach($values as $value){
            $options->insert(['title' => $value, 'decision_id' => $decision->id]);
        }

        flash()->success(trans('alert.new_decision'));

        return redirect('/decision/'.$decision->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,\Parsedown $parsedown)
    {
        $decision = Decision::findOrFail($id);

        $option = $this->voted($id);

        $decision['body'] = $parsedown->text($decision['body']);

        return view('decision.show',compact('decision','option'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoteRequest $request,$id)
    {
        dd($request);
    }

    public function vote(VoteRequest $request,SkillCheck $check,Vote $vote)
    {
        $input = $request->all();

        $decision = Decision::where('state',3)->findOrFail($input['decision_id']);

        $option = $this->voted($input['decision_id']);

        $match = $check->check($decision);          //检查此决策所需的技能是否与用户拥有的技能匹配

        if(!$match){
            flash()->warning(trans('alert.decision_not_matched'))->important();
            return redirect('/decision/'.$input['decision_id']);
        }

        if((Gate::denies('can_vote', $decision))OR $option){

            flash()->warning('Opps.');

            return redirect('/');
        }

        DB::transaction(function() use ($input,$vote,$decision){

            \Auth::user()->where('id',\Auth::id())
                         ->update(['voting' => \Auth::user()->voting-$input['amount']]);
            $vote->insert(['decision_id' => $input['decision_id'], 'amount' => $input['amount'], 'user_id' => \Auth::id(), 'option_id' => $input['option']]);

            $option = Option::where('id',$input['option'])->first();

            $option->update(['amount' => $option->amount+$input['amount']]);

            $amount = $vote->where(['decision_id' => $input['decision_id']])->sum('amount');

            $decision->update(['amount' => $amount]);

        });

        flash()->success(trans('decision.success'));

        return redirect('/decision/'.$input['decision_id']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Decision::where('id',$id)->
                where('user_id',\Auth::id())->
                where('state',3)->
                delete();

        return redirect('/decision');
    }

    private function voted($id)
    {
        return Vote::where('decision_id',$id)
            ->where('user_id',\Auth::id())
            ->first();
    }
}
