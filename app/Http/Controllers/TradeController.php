<?php

namespace App\Http\Controllers;

use App\Trade;
use App\Status;
use Illuminate\Http\Request;
use Clockos\ChangeRate;

use App\Http\Requests\TradeRequest;
use App\Http\Controllers\Controller;

class TradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trade = Trade::where('state',4)->paginate(30);

        $status = Status::latest()->first();

        return view('finance.trade',compact('trade','status'));
    }

    public function purchase()
    {
        $trade = Trade::where('state',0)->paginate(30);

        return view('finance.purchase',compact('trade'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $remain = Trade::remainStocks();

        if($remain<1){
            flash()->warning(trans('alert.no_remain_stock'))->important();
            return redirect('/finance/trade');
        }

        return view('finance.create',compact('remain'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TradeRequest $request)
    {
        $input = $request->all();

        $input['price'] = ChangeRate::toUsd($input['price']);

        $input['average'] = $input['price']/$input['amount'];

        \Auth::user()->sell()->create($input);

        flash()->info(trans('alert.sell_list'));

        return redirect('/finance/trade');
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
        $trade = new Trade;

        dd($trade->remainStocks());
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
