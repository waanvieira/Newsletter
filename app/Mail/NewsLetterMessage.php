<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class NewsLetterMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $message;

    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.message_created',
            with: [
                'name' => $this->user->name,
                'messageContent' => $this->message->message,
                'title' => $this->message->title
            ],
        );
    }
}
