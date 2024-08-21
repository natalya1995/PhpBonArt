<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Jobs\SendNotificationEmail;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

    
        $notification = Notification::create($data);

      
        SendNotificationEmail::dispatch($notification);

        return response()->json(['message' => 'Notification created and email sent successfully'], 200);
    }
}
