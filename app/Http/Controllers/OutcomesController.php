<?php

namespace App\Http\Controllers;

use App\Jobs\OutcomeExecuted;
use Illuminate\Http\Request;

use App\Http\Requests\OutcomeRequest;
use App\Http\Controllers\Controller;
use App\Outcome;
use App\Status;
use Clockos\ChangeRate;
use App\Jobs\OutcomeGrant;

class OutcomesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('add_outcome', ['only' => ['create', 'store']]);

        $this->middleware('check_outcome', ['only' => ['grant','executed']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = \Request::all();

        array_forget($input, 'page');

        $status = Status::latest()->first();

        $outcome = Outcome::where($input)->latest('start')->paginate(30);

        return view('finance.outcome',compact('outcome','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finance.outcome_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutcomeRequest $request)
    {
        $input = $request->all();

        $input['price'] = ChangeRate::toUsd($input['price']);

        $input['average'] = $input['price']/$input['amount'];

        $outcome = \Auth::user()->outcome()->create($input);

        flash()->success(trans('alert.new_outcome'));

        return redirect('/finance/outcome/'.$outcome->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,\Parsedown $parsedown)
    {
        $outcome = Outcome::findOrFail($id);

        $outcome['body'] = $parsedown->text($outcome['body']);

        return view('finance.outcome_show',compact('outcome'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function grant($id)
    {
        $outcome = Outcome::where('state',0)->findOrFail($id);

        $outcome->checker_id = \Auth::id();

        $outcome->state = 2;

        $outcome->save();

        $this->dispatch(new OutcomeGrant());

        flash()->success(trans('alert.outcome_granted'));

        return redirect('/finance/outcome/'.$id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function executed($id)
    {
        $outcome = Outcome::where('state',2)->findOrFail($id);

        $outcome->state = 4;

        $outcome->save();

        $this->dispatch(new OutcomeExecuted());

        flash()->success(trans('alert.outcome_executed'));

        return redirect('/finance/outcome/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Outcome::where('id',$id)->
        where('user_id',\Auth::id())->
        where('state',0)->
        delete();

        flash()->success(trans('alert.deleted'));

        return redirect('/finance/outcome');
    }
}
