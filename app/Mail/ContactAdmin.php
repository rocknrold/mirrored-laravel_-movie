<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;


class ContactAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $message,$subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->data);
        return $this->from(Auth::user()->email)
                ->markdown('vendor.mail.text.message')
                ->with([
                    'subject' => $this->subject,
                    'message' => $this->message,
                    'user' => Auth::user()->name
                ]);
    }
}
