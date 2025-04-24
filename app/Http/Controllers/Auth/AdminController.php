<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{

    public function store(AdminLoginRequest $request)
    {
        //
        $credentials = $request->only('email', 'password');

    if (auth('admins')->attempt($credentials)) {
        Cache::put('user_name' , Auth::guard('admins')->user()->name , 3600 );
        Cache::put('user_email' , Auth::guard('admins')->user()->email , 3600 );
        return redirect()->route('dashboard.admin');
    }


    return redirect()->back()->withErrors(trans('Dashboard/auth.failed'));
    }

    public function destroy(Request $request)
    {
        //
        Auth::guard('admins')->logout();
        Cache::forget('user_name');
        Cache::forget('user_email');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
