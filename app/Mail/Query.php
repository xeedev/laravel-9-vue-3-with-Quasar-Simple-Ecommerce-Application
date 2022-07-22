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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('', $this->user)
            ->subject("New Query From {$this->user}")->view('emails.query')->with([
                'text' => $this->text
            ]);
    }
}
