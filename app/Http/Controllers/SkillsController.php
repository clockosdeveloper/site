<?php

namespace App\Http\Controllers;

use Guzzle\Http\Message\Response;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Skill;
use App\Http\Requests\SkillRequest;
use App\Http\Controllers\Controller;
use Clockos\Transformers\SkillTransformer;

class SkillsController extends Controller
{
    /**
     * @var Clockos\Transformers\SkillTransformer
     */
    protected $skillTransformer;

    /**
     * SkillsController constructor.
     * @param Clockos\Transformers\SkillTransformer $lessonTransformer
     */
    public function __construct(SkillTransformer $skillTransformer)
    {
        $this->skillTransformer = $skillTransformer;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Auth::user()->skills()->get();

        $data['languages']  = Skill::where('parent_id',1)->get();
        $data['visuals']  = Skill::where('parent_id',2)->get();
        $data['maintenance']  = Skill::where('parent_id',3)->get();
        $data['consultant']  = Skill::where('parent_id',4)->get();
        $data['operating']  = Skill::where('parent_id',5)->get();

        return view('roles.skills',$data);
    }

    /**
     * 读取一个技能下的子技能
     */
    public function subSkills($id)
    {
        //用户已经拥有的技能
        $skill = Auth::user()->skills()->get();

        //用户要选的新的子技能
        $skills = Skill::where('parent_id',$id)->orderBy('name')->get();

        //从新的自己能当中去除已经拥有的技能
        $skills = $skills->diff($skill);

        $view = \View::make('partials.subskills',compact('skills'));

        $contents = $view->render();

        return $contents;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $request)
    {

        Auth::user()->skills()->attach($request->input('subskill'));

        flash()->success(trans('alert.skill_selected'));

        $return = session('redirect')?session('redirect'):'quests';

        session()->forget('redirect');

        return redirect($return);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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

}
