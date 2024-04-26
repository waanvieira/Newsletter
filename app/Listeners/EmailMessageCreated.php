<?php

namespace App\Listeners;

use App\Mail\NewsLetterMessage;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Mail;

class EmailMessageCreated
{
    protected $rabbitInterface;

    public function __construct($event)
    {
        $this->handle($event);
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        $newsletter = NewsLetter::find($event->newsletter_id);
        $users = $newsletter->users()->get();
        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new NewsLetterMessage($user, $event));
        }
    }
}
