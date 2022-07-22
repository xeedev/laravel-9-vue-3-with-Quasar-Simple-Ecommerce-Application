<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Query extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $text;
    protected $email;
    protected $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $text, $email, $contact)
    {
        $this->user = $user;
        $this->text = $text;
        $this->email = $email;
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('', $this->user)
            ->subject("New Query From:- {$this->user}")->view('emails.query')->with([
                'name' => $this->user,
                'text' => $this->text,
                'email' => $this->email,
                'contact' => $this->contact
            ]);
    }
}
