<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function markAsRead($guard){
        Auth::guard($guard)->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
