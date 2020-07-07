<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function testEmail()
    {
        try {
            $to_name = 'Test';
            $to_email = 'ahmadyudafahrudin@gmail.com';
            $data = array('name' => 'Test Name', 'body' => 'test email');
            Mail::send('emails.mail', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Test Mail');
                $message->from('pinterusindonesia@gmail.com', 'tes tmail');
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
