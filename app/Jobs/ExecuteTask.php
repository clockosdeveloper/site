<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Status;
use Illuminate\Contracts\Queue\ShouldQueue;


class ExecuteTask extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $quest_open = Status::questsNum([2]);                 //等待中的任务数

        $quest_doing = Status::questsNum([3]);                 //等待中的任务数

        $status = ['quests_open' => $quest_open, 'quests_doing'=> $quest_doing];

        Status::updateStatus($status);
    }
}
