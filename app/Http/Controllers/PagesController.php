<?php

namespace App\Http\Controllers;

use App\Weekly;
use App\Status;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function __construct()
    {

    }
    //


    function about($page){

        return view('about.'.$page);

    }

    public function contact(){
        return view('about.contact');
    }

    public function home(){

        $last_week = Weekly::latest()->first();

        $status = Status::latest()->first();

        return view('user.home',compact('last_week','status'));
    }
}
