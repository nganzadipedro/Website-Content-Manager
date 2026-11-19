<?php

namespace App\Http\Controllers;

use App\Lib\Repositories\ProxyPayRepository;
use Illuminate\Http\Request;

class APIProxyPayController extends Controller
{
    function webhookPayment(Request $request)
    {

        $api_key = "usorxf47m24rjwdkrfn2ef6qhezxsd5j";

        $input = @file_get_contents("php://input");
        $header_signature = $_SERVER['HTTP_X_SIGNATURE'];

        $signature = hash_hmac('sha256', $input, $api_key);

        if ($signature == $header_signature) {
        // if ('12345' == $header_signature)
        
            $payment = json_decode($input);
            $ob = new ProxyPayController();
            return $ob->processaPagamento($payment->reference_id);

        } else {
            return response()->json("", 400);
        }
    }
}
