<?php

namespace App\Services;

use GuzzleHttp\Client;

class SenangpayService
{
    protected $merchantId;
    protected $secretKey;
    protected $returnUrl;

    public function __construct()
    {
        $this->merchantId = env('SENANGPAY_MERCHANT_ID');
        $this->secretKey = env('SENANGPAY_SECRET_KEY');
        $this->returnUrl = env('SENANGPAY_CALLBACK_URL');
    }

    public function senangPay($method, $url, $data)
    {
        $client = new Client();

        $response = $client->{$method}($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode("YOUR_MERCHANT_ID:$this->merchantId"),
            ],
            'json' => $data
        ]);

        return $responseData = json_decode($response->getBody(), true) ?? 'ere';
    }

    protected function generateHash($orderID, $amount)
    {
        $hashString = $this->secretKey . $this->merchantId . $orderID . $amount . $this->returnUrl;

        return hash('sha256', $hashString);
    }
}
