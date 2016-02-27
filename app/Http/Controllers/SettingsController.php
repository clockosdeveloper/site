<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingsController extends Controller
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
        $data['sponsor_privacy'] = (\Auth::user()->settings()->first()->sponsor_code)?'checked':'';//检查用户是否设置通过邮箱查找

        return view('user.setting');
    }

    public function switchSetting(Request $request)
    {
        $input = $request->all();

        $type = $input['type'];

        $present = \Auth::user()->settings()->first()->$type;

        $newStatus = 1-$present;

        Setting::where('user_id',\Auth::id())
            ->update([$type=>$newStatus]);

        return $newStatus;
    }
}
