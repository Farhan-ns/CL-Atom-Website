<?php

namespace App\Contracts;

interface WhatsAppServiceInterface
{
    public function sendMessage(string $to, string $message): void;
}
