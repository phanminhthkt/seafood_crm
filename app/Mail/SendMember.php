<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMember extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $_data;
    public function __construct($data)
    {
        $this->_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('minhthkt2@gmail.com')->subject("Đặc Tả Lập Trình ".$this->_data->name)->replyTo('minhthkt2@gmail.com')->view('backend.member.mail',['item' => $this->_data] );
    }
}
