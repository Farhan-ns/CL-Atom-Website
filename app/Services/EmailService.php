<?php

namespace App\Services;

use App\Contracts\WhatsAppServiceInterface;
use Exception;
use Illuminate\Support\Facades\Mail;

class EmailService implements WhatsAppServiceInterface
{
    public function sendMessage(string $to, string $message): void
    {
        Mail::raw($message, function ($mail) use ($to) {
            $mail->to($to)->subject('[MOCK] Whatsapp Message');
        });
    }
}
