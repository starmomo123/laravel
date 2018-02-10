<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class sendMessgae implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $notice;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Notice $notice)
    {
        //
        $this->notice=$notice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //任务的具体逻辑
        //为每个用户添加任务
        $users=User::all();
        foreach ($users as $user){
            $user->addNotice($this->notice);
        }
    }
}
