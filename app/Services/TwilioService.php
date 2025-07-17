<?php

namespace App\Services;

use App\Contracts\WhatsAppServiceInterface;
use App\DTO\ContentTemplate;
use Exception;
use Twilio\Rest\Client;

class TwilioService implements WhatsAppServiceInterface
{
    private $twilio_sid;
    private $twilio_token;
    private $twilio_from;
    private Client $twilio_client;

    public function __construct()
    {
        $this->twilio_sid = config('twilio.twilio_sid');
        $this->twilio_token = config('twilio.twilio_token');
        $this->twilio_from = config('twilio.twilio_from');

        if (empty($this->twilio_sid) || empty($this->twilio_token)) {
            throw new Exception('Twilio SID and token cannot be empty.');
        }

        $this->twilio_client = new Client($this->twilio_sid, $this->twilio_token);
        // $this->twilio_client->content->v1->contents();
    }

    public function sendMessage(string $to, string $message): void
    {
        // TODO implement Twilio Api Call
        throw Exception('Unimplemented');
    }

    /**
     * Fetch a Twilio content template by SID.
     *
     * @param string $templateSid
     * @return ContentTemplate
     * @throws Exception
     */
    public function fetchTemplate(string $templateSid): ContentTemplate
    {
        try {
            // Try the correct Twilio Content API endpoint
            $template = $this->twilio_client
                ->content
                ->v1
                ->contents($templateSid) // Use 'contents' instead of 'contentSid'
                ->fetch();

            return ContentTemplate::fromTwilio($template);
        } catch (Exception $e) {
            throw new Exception("Failed to fetch template: " . $e->getMessage(), 500);
        }
    }
}
