<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;
    public $otp;
    public $name = 'Customer'; // Default name, can be overridden
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp,$name)
    {
            $this->otp = $otp;
            $this->name = $name; // Set the name if provided, otherwise it defaults to 'Customer'
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->view('emails.send-otp')  // ✅ Use the correct path
                ->subject('Your OTP Code')
                ->with([
                    'otp' => $this->otp,
                    'name' => $this->name,
                ]);
    }
}
