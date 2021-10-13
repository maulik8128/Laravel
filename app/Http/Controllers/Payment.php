<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Payment extends Controller
{
    public function submit()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array("X-Api-Key:test_1ce802f02dca25bc15a44cbaed6",
                        "X-Auth-Token:test_cb0899d5f770163aab1fe54e932"));
        $payload = Array(
            'purpose' => 'Buy Domain',
            'amount' => '2500',
            'phone' => '9999999999',
            'buyer_name' => 'John Doe',
            'redirect_url' => "http://laravel.local/payment/redirect",
            'send_email' => true,
            // 'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => 'foo@example.com',
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        // echo "<pre>";
        // print_r($response->payment_request->longurl);
        return redirect($response->payment_request->longurl);

    }

    public function redirect()
    {
        print_r($_GET);
    }
}
