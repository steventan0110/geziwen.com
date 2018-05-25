<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/5/22
 * Time: 15:04
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sms;
use Illuminate\Support\Facades\Session;

class SmsController extends Controller
{

    protected function generate_code($length) {
        $min = pow(10 , ($length - 1));
        $max = pow(10, $length) - 1;
        return rand($min, $max);
    }

    public function send(Request $request) {
        $vcode = $this->generate_code(6);
        session(['vcode'=>$vcode]);
        $phoneNumber = $request->phoneNumber;
        $sig = $request->sig;
        $urlRandom = $request->urlRandom;
        $url = 'https://yun.tim.qq.com/v5/tlssmssvr/sendsms?sdkappid=1400093698&random='.$urlRandom;
        function http_post_json($url, $jsonStr)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length: ' . strlen($jsonStr)
                )
            );
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return array($httpCode, $response);
        }
        $jsonStr = json_encode(array(
            "ext" => "",
            "extend" => "",
            "params" => [
                $vcode,
                "30"
            ],
            "sig" => $sig,
            "sign" => "哥子稳",
            "tel" => [
                "mobile" => $phoneNumber,
                "nationcode" => "86"
            ],
            "time" => $request->time,
            "tpl_id" => 126597
        ));
        list($returnCode, $returnContent) = http_post_json($url, $jsonStr);
    }
}