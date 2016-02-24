<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Notification;
use Clockos\AppMailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Status;

class PublishTask extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $quest;

    public function __construct($quest)
    {
        $this->quest = $quest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(AppMailer $mailer)
    {
        $notification['title'] = trans('notification.task_published');

        $notification['content'] = trans('notification.task_published_content',['title' => $this->quest->title]);

        $notification['link'] = url("/quests/".$this->quest->id);

        $notification['email'] = $this->quest->user->email;

        Notification::create(['title' => 'task_published','body' => $notification['link'], 'user_id' => $this->quest->user->id]);

        if(\Auth::user()->settings()->first()->email_task_published){
            $mailer->sendEmailNotificationTo($notification);
        }
        
        $stock_wait = Status::stocksNum([1,2,3]);             //待发行股权的总数

        $quest_wait = Status::questsNum([1]);                 //等待中的任务数

        $status = ['stock_wait' => $stock_wait, 'quests_wait'=> $quest_wait];

        Status::updateStatus($status);
    }
}
