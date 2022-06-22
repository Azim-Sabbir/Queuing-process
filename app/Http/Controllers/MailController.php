<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Store;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $stores = Store::query()->get();

        foreach($stores as $store){
            $job = new SendEmailJob($store);

            $this->dispatch($job);
        }

        $result = "mail sent to All stores";

        return view('dashboard', compact('result'));
    }
}
