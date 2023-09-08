<?php

namespace App\Http\Controllers;

use App\Mail\RegisterEmail;

use Illuminate\Support\Facades\Mail;

class SendEmail extends Controller
{
    public function index()
    {
        Mail::to('test@gmail.com')->send(new RegisterEmail);
    }
}
