<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Clockos\AppMailer;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSponsorFound extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $user;

    private $message;

    public function __construct($user,$message)
    {
        $this->user = $user;

        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(AppMailer $mailer)
    {
        if(\Auth::user()->settings()->first()->email_found_me){
            $notification['title'] = trans('notification.sponsor_found');

            $notification['content'] = $this->message;

            $notification['link'] = url("team");

            $notification['email'] = $this->user->email;

            $mailer->sendEmailNotificationTo($notification);
        }
    }
}
