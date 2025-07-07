<?php

namespace App\Jobs;

use App\Contracts\WhatsAppServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendBirthdayMessage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $to)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(WhatsAppServiceInterface $service): void
    {
        $service->sendMessage($this->to, 'This is a mock schedule');
    }
}
