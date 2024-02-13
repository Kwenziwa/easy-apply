<?php

namespace App\Services;

use GuzzleHttp\Client;

class SmsService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('SMS_TO_API_KEY'); // Make sure you have SMS_TO_API_KEY in your .env file
    }

    public function sendSms($to, $message)
    {
        $response = $this->client->post('https://api.sms.to/sms/send', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'message' => $message,
                'to' => $to,
                'bypass_optout' => true,
                'sender_id' => 'SMSto',
                'callback_url' => 'https://example.com/callback/handler',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
