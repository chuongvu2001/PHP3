<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function sendmail(){
        $to_name = ['thienth', 'Nguyễn Tấn Cường', 'Lương Quốc Vương'];
        $to_email = ['thienth@fpt.edu.vn', 'cuongntph09597@fpt.edu.vn', 'vuongxang@gmail.com'];
        $data = array('name'=>'Ogbonna Vitalis(sender_name)', 'body' => 'A test mail');
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Laravel Test Mail');
            $message->from('phamthu2000vn@gmail.com','Test Mail');
        });
    }
}
