<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quest;

class MyQuestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $input = \Request::all();

        array_forget($input, 'page');

        $type = @$input['type'];

        if($type){
            $quests = Quest::where([$type => \Auth::id()])->paginate(12);
        }else{
            $quests = Quest::where('user_id',\Auth::id())
                           ->orWhere('execution_id',\Auth::id())
                           ->orWhere('checker_id',\Auth::id())
                           ->orWhere('final_checker_id',\Auth::id())
                           ->latest('updated_at')
                           ->paginate(12);

        }

        return view('quest.my',compact('quests'));
    }

}
