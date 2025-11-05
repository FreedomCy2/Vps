<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminSupportRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function build()
    {
        $subject = 'Support request from ' . ($this->payload['name'] ?? 'Admin');

        return $this->subject($subject)
                    ->replyTo($this->payload['email'])
                    ->view('emails.admin.support-request')
                    ->with('data', $this->payload);
    }
}