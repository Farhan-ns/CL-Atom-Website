<?php

namespace App\Services;

use App\Contracts\WhatsAppServiceInterface;
use Exception;
use Twilio\Rest\Client;

class TwilioService implements WhatsAppServiceInterface
{
    private $twilio_sid;
    private $twilio_token;
    private $twilio_from;
    private $twilio_client;

    public function __construct()
    {
        $this->twilio_sid = config('twilio.twilio_sid');
        $this->twilio_token = config('twilio.twilio_token');
        $this->twilio_from = config('twilio.twilio_from');

        if (empty($this->twilio_sid) || empty($this->twilio_token)) {
            throw new Exception('Twilio SID and token cannot be empty.');
        }

        $this->twilio_client = new Client($this->twilio_sid, $this->twilio_token);
    }

    public function sendMessage(string $to, string $message): void
    {
        // TODO implement Twilio Api Call
        throw Exception('Unimplemented');
    }
}
