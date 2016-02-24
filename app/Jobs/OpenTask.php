<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Status;
use Illuminate\Contracts\Queue\ShouldQueue;

class OpenTask extends Job implements SelfHandling,ShouldQueue
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

        $quest_wait = Status::questsNum([1]);                 //等待中的任务数

        $status = ['quests_open' => $quest_open, 'quests_wait'=> $quest_wait];

        Status::updateStatus($status);
    }
}
