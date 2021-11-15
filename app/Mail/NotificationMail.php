<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $notifications;

    public function __construct($notifications){
        $this->notifications = $notifications;
    }

    public function build(){
        return $this->subject('Twoje przypomnienia z TFM!')
                    ->markdown('emails.notification')
                    ->with(['notifications' => $this->notifications]);
    }
}
