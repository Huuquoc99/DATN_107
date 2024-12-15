<?php

namespace App\Http\Controllers\Client;

use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Vui lòng cung cấp tên của bạn.',
            'name.string' => 'Tên phải là một chuỗi hợp lệ.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',

            'email.required' => 'Vui lòng cung cấp địa chỉ email của bạn.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'message.required' => 'Vui lòng viết tin nhắn.',
            'message.string' => 'Tin nhắn phải là một chuỗi hợp lệ.',
        ]);

        $catalogues = Catalogue::where('is_active', 1)->get();

        Mail::to('hoadtph31026@fpt.edu.vn')->send(new ContactFormMail($validated));
        Mail::to($validated['email'])->send(new ContactFormMail($validated, true));

        return back()->with('success', 'Tin nhắn của bạn đã được gửi!')->with(compact('catalogues'));
    }

}
