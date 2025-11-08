<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSupportRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function build()
    {
        $subject = 'Support request from ' . ($this->payload['name'] ?? 'User');

        return $this->subject($subject)
                    ->replyTo($this->payload['email'])
                    ->view('emails.user.support-request')
                    ->with('data', $this->payload);
    }
}