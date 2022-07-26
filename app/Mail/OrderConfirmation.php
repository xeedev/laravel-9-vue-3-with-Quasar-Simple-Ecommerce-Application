<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $text;
    protected $email;
    protected $contact;
    protected $total;
    protected $transaction_id;
    protected $address;
    protected $city;
    protected $country;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $text, $contact ,$email,$total, $transaction_id, $address, $city, $country)
    {
        $this->user = $user;
        $this->text = $text;
        $this->email = $email;
        $this->contact = $contact;
        $this->total = $total;
        $this->transaction_id = $transaction_id;
        $this->address = $address;
        $this->city = $city;
        $this->country = $country;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('', 'WOOD SURFACE')
            ->subject("Order Confirmation")->view('emails.order-confirmation')->with([
                'user' => $this->user,
                'text' => $this->text,
                'email' => $this->email,
                'contact' => $this->contact,
                'total' => $this->total,
                'transaction_id' => $this->transaction_id,
                'address' => $this->address,
                'city' => $this->city,
                'country' => $this->country,
            ]);
    }
}
