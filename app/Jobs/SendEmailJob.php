<?php

namespace App\Jobs;

use App\Mail\SendEmailMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Redis\LimiterTimeoutException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $shop;

    /**
     * Create a new job instance.
     *
     * @param $shop
     */
    public function __construct($shop)
    {
        $this->shop = $shop;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws LimiterTimeoutException
     */
    public function handle()
    {





        // Allow only 2 emails every 1 second
        Redis::throttle('any_key')->allow(2)->every(1)->then(function () {

            $email = $this->shop->email;
            Mail::to($email)->send(new SendEmailMailable($this->shop));

            Log::info('Emailed shop ' . $this->shop->id);
        }, function () {
            // Could not obtain lock; this job will be re-queued
            return $this->release(2);
        });

    }
}
