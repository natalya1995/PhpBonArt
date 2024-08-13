<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Mail::send([], [], function ($message) use ($data) {
            $message->to('nata.mark140895@gmail.com')
                ->subject('New message from ' . $data['name'])
                ->html('Имя: ' . $data['name'] . '<br>Email: ' . $data['email'] . '<br>Сообщение: ' . $data['message']);
        });

        return response()->json(['message' => 'Email sent successfully'], 200);
    }
}
