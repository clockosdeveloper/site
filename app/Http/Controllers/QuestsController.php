<?php

namespace App\Http\Controllers;


use App\Skill;
use App\Status;
use Gate;
use App\Department;
use App\Http\Requests\QuestRequest;
use App\Quest;
use Illuminate\Support\Facades\Auth;

class QuestsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('profile', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $input = \Request::all();

        array_forget($input, 'page');



        if(array_key_exists('level', $input)){
            $level = "`min_level`".$input['level'];
            $quests = Quest::whereRaw($level);
        }elseif(array_key_exists('department', $input)){
            $quests = Quest::whereHas('departments', function ($query) use ($input) {
                $query->where('fullname','LIKE','%'.$input['department'].'%');
            });
        }elseif(array_key_exists('recommend', $input)){
            $quests = Quest::where('min_level','<=',\Auth::user()->level)
                           ->where('state',2);
        }else{
            $quests = Quest::where($input);
        }

        $quests = $quests->latest()->paginate(12);

        return view('quest.list',compact('quests'));
    }

    public function show($id,\Parsedown $parsedown)
    {

        $quest = Quest::findOrFail($id);

        $quest['body'] = $parsedown->text($quest['body']);

        $prerequisite = Quest::prerequisite($id);

        return view('quest.show',compact('quest','prerequisite'));
    }

    public function create()
    {
        $departments = Department::lists('fullname','id');

        $status = Status::latest()->first();

        $skills = Skill::lists('fullname','id');

        return view('quest.create',compact('departments','skills','status'));
    }

    public function store(QuestRequest $request)
    {
        $input = $request->all();

        $type  = trans('form.'.$input['type']);

        $state = trans('form.0');       //审核中/Draft

        $input['fullname'] = $type.'-'.$state.'-'.$input['title'];

        $quest = Auth::user()->quests()->create($input);

        $quest->departments()->attach($request->input('department_list'));

        $quest->quests()->attach($request->input('quest_list'));

        $quest->skills()->attach($request->input('skill_list'));

        Status::allQuestsNum();

        flash()->success(trans('alert.new_task'));

        return redirect('/quests/'.$quest->id);
    }

    public function edit($id)
    {
        $status = Status::latest()->first();

        $quest = Quest::where('state',0)->findOrFail($id);

        if(Gate::denies('update', $quest)){

            flash()->warning('Opps.');

            return redirect('/');
        }

        $departments = Department::lists('fullname','id');

        $skills = Skill::lists('fullname','id');

        $prerequisite = Quest::prerequisite($id);

        return view('quest.edit',compact('quest','departments','skills','status','prerequisite'));
    }

    public function update($id, QuestRequest $request)
    {
        $quest = Quest::findOrFail($id);

        if(Gate::denies('update', $quest)){

            if($request->ajax()) {
                return response(['message' => 'Opps.'], 403);
            }

            flash()->warning('Opps.');

            return redirect('/');
        }

        $input = $request->all();

        $type  = trans('form.'.$input['type']);

        $state = trans('form.0');       //审核中/Draft

        $input['fullname'] = $type.'-'.$state.'-'.$input['title'];

        $quest->update($input);

        $department_list = $request->input('department_list');

        $skill_list = $request->input('skill_list');

        $quest_list = $request->input('quest_list');

        if($quest_list){
            $quest->quests()->sync($quest_list);
        }

        $quest->departments()->sync($department_list);

        $quest->skills()->sync($skill_list);

        flash()->success(trans('form.updated'));

        return redirect('/quests/'.$id);
    }

    public function destroy($id)
    {
        $delete = Quest::where('id',$id)->
               where('user_id',\Auth::id())->
               where('state',0)->
               delete();

        if($delete){
            Status::allQuestsNum();
        };

        return redirect('/quests');
    }

}
