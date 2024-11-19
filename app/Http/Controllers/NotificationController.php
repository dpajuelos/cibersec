<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        
        if ($notification) {
            $notification->delete();
        }

        return redirect()->back();
    }
}