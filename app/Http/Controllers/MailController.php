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
        $user = \DB::table('users')->where('email',$address)->get();
        if($user->first() != null) {
            return response("address has been registered", 505);
        }
        $verificaiton = new Vcode();
        Mail::to($address)->send($verificaiton);
        return response("vcode has been sent", 200);
    }
}
