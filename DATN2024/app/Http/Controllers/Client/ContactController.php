<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Please provide your name.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name cannot exceed 255 characters.',
            
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email cannot exceed 255 characters.',
            
            'message.required' => 'Please write a message.',
            'message.string' => 'The message must be a valid string.',
        ]);
        

        Mail::to('hoadtph31026@fpt.edu.vn')->send(new ContactFormMail($validated));

        Mail::to($validated['email'])->send(new ContactFormMail($validated, true));

        return back()->with('success', 'Your message has been sent!');
    }
}
