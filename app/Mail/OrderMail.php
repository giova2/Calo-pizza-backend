<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class OrderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $name, $email, $contact, $updated_at, $address, $total, $currency, $status, $items;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $date = Carbon::now();
        $this->name         = $order['name'];
        $this->email        = $order['email'];
        $this->contact      = $order['contact'];
        $this->updated_at   = $date->isoFormat('D/M/YY HH:mm');
        $this->address      = $order['address'];
        $this->total        = $order['total'];
        $this->currency     = $order['currency'];
        $this->status       = $order['status'];
        $this->items        = $order['items'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order')->subject("Your Order details at ".config('app.name'))->with([
            'name'       =>$this->name,      
            'email'      =>$this->email,     
            'contact'    =>$this->contact,   
            'updated_at' =>$this->updated_at,
            'address'    =>$this->address,   
            'total'      =>$this->total,     
            'currency'   =>$this->currency,  
            'status'     =>$this->status,    
            'items'      =>$this->items,
        ]);
    }
}
