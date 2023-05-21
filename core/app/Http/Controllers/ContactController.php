<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string']
        ]);


        Mail::to(env("CONTACT_EMAIL"))->send(new ContactMail(
            first_name: $request->first_name,
            last_name: $request->last_name,
            email: $request->email,
            message: $request->message
        ));
    }
}
