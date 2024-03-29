<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\{ Order, Shop, page };

class Ordered extends Mailable
{
    use Queueable, SerializesModels;

    public $shop;
    public $order;
    public $page;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(  $shop,  $order,  $page)
    {
        $this->shop = $shop;
        $this->order = $order;
        $this->page = $page;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->shop->email, $this->shop->name)
                    ->subject('Confirmation de commande')
                    ->view('mail.ordered', ['user' => auth()->user()]);
    }
}