<?php

namespace App\Http\Controllers;

use App\Mail\Vcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
class MailController extends Controller
{
    public function send(Request $request)
    {
        $address = $request->address;
        $verificaiton=new Vcode();
        Mail::to($address)->send($verificaiton);
    }
}
