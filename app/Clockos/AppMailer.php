<?php
/**
 * Created by PhpStorm.
 * User: YELLOVE
 * Date: 12/31/2015
 * Time: 1:24 PM
 */

namespace Clockos;


use Illuminate\Contracts\Mail\Mailer;
use App\User;

class AppMailer
{
    protected $mailer;

    protected $from = 'admin@clockos.com';

    protected $to;

    protected $view;

    protected $data = [];

    protected $subject;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    private function deliver()
    {
        $this->mailer->send($this->view, $this->data ,function($message){
            $message->from($this->from, 'clockOS Developer')
                    ->to($this->to)
                    ->subject($this->subject);
        });
    }

    public function sendEmailConfirmationTo($user)
    {
        $this->to = $user['email'];
        if(\App::getLocale()=='zh'){
            $template = 'emails.confirm';
        }else{
            $template = 'emails.confirm_en';
        }
        $this->view = $template;

        $this->data = $user;

        $this->subject = trans('auth.confirmation');

        $this->deliver();
    }

    public function sendEmailNotificationTo($notification)
    {
        $this->to = $notification['email'];

        $this->view = 'emails.notification';

        $this->data = $notification;

        $this->subject = $notification['title'];

        $this->deliver();
    }
}