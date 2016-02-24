<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Clockos\AppMailer;
use App\Activation;

class RegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request,AppMailer $mailer)
    {

        $user = $request->all();

        $user['token'] = str_replace("/", "-", bcrypt($user['email'] . time()));

        $user['password'] = bcrypt($user['password']);

        $mailer->sendEmailConfirmationTo($user);

        Activation::where('email',$user['email'])->delete();

        Activation::create($user);

        return view('emails.sent');

    }

}
