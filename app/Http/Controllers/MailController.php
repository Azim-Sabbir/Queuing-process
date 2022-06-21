<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        Mail::to('mohammadsabbir044@gmail.com')->send(new SendEmailMailable());

        $result = "mail sent to user";

        return view('dashboard', compact('result'));
    }
}
