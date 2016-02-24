<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class LanguagesController extends Controller
{
    public function switchLang($lang)
    {

        Session::set('applocale', $lang);
        return Redirect::back();
    }
}
