<?php

namespace App\Jobs;

use App\Invest;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Outcome;
use App\Status;

class OutcomeExecuted extends Job implements SelfHandling, ShouldQueue
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
        $outcome_wait = Outcome::where('state',2)->sum('price');

        $outcome = Outcome::where('state',4)->sum('price');
        
        $invested = Invest::invested();
        
        $cash_flow = $invested-$outcome;

        Status::updateStatus(['outcome_wait' => $outcome_wait,'outcome' => $outcome,'cash_flow' => $cash_flow]);
    }
}
