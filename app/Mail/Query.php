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
    protected $product_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $text, $email, $contact, $product_id = null)
    {
        $this->user = $user;
        $this->text = $text;
        $this->email = $email;
        $this->contact = $contact;
        $this->product_id = $product_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!$this->product_id){
            return $this->from('', $this->user)
                ->subject("New Query From:- {$this->user}")->view('emails.query')->with([
                    'name' => $this->user,
                    'text' => $this->text,
                    'email' => $this->email,
                    'contact' => $this->contact
                ]);
        }else{
            return $this->from('', $this->user)
                ->subject("Product Query From:- {$this->user}")->view('emails.query')->with([
                    'name' => $this->user,
                    'text' => $this->text,
                    'email' => $this->email,
                    'contact' => $this->contact,
                    'product_id' => $this->product_id,
                ]);
        }
    }
}
