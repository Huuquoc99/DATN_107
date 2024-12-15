<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = AdminNotification::query()->latest('id')->paginate(6);
        if ($request->get('page') > 1) {
            return view("admin.notification.data", compact('notifications'));
        }
        return view("admin.notification.index", compact('notifications'));
    }
}
