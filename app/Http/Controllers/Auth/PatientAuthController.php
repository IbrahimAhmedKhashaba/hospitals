<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PatientAuthController extends Controller
{
    public function store(Request $request)
    {
        //
        $credentials = $request->only('email', 'password');
        if (auth('patients')->attempt($credentials)) {
            Cache::put('user_name' , Auth::guard('patients')->user()->name , 3600 );
            Cache::put('user_email' , Auth::guard('patients')->user()->email , 3600 );
            return redirect()->route('dashboard.patients');
        }

        return redirect()->back()->withErrors(trans('Dashboard/auth.failed'));
    }

    public function destroy(Request $request)
    {
        //
        Auth::guard('patients')->logout();
        Cache::forget('user_name');
        Cache::forget('user_email');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
