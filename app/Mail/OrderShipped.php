<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Cart;
class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    
    public function __construct($allRequest)
    {
        $this->allRequest = $allRequest;
    }

    public function build()
    {
        // Mail::send('Html.view', $data, function ($message) {
        //     $message->from('john@johndoe.com', 'John Doe');
        //     $message->sender('john@johndoe.com', 'John Doe');
        //     $message->to('john@johndoe.com', 'John Doe');
        //     $message->cc('john@johndoe.com', 'John Doe');
        //     $message->bcc('john@johndoe.com', 'John Doe');
        //     $message->replyTo('john@johndoe.com', 'John Doe');
        //     $message->subject('Subject');
        //     $message->priority(3);
        //     $message->attach('pathToFile');
        // });
        
        return $this->from('individualstc@gmail.com','Nội Thất Thông Minh')
        ->subject('Thông báo xác nhận lại đơn hàng .')
        ->view('emails.order')
        ->with([
            'cart'      => Cart::getContent(),
            'request'   => $this->allRequest
        ]);
    }
}
