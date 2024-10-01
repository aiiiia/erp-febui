<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBulkQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    public $timeout = 7200; // 2 jam

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        $i = 0;
        foreach ($this->data as $value) {
            sendmail($value);
            sleep(5);
            if (config('env.IS_MAIL_SEND_HAS_LIMIT') && $i == 5)
                break;
            else
                $i++;
        }
    }

    public function failed(Exception $exception)
    {
        // Send user notification of failure, etc...
        // echo "Error";
    }
}
