<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        for ($i = 0; $i < 10; $i++){

//            $job = (new SendEmailJob($i))->delay(Carbon::now()->addSeconds(10));
            $job = new SendEmailJob($i);

            $this->dispatch($job);
        }

        $result = "mail sent to 10 users";

        return view('dashboard', compact('result'));
    }
}
