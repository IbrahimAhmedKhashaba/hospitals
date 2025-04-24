<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LaboratoryEmployeeAuthController extends Controller
{
    //
    public function store(AdminLoginRequest $request)
    {
        //
        $credentials = $request->only('email', 'password');

    if (auth('laboratory_employees')->attempt($credentials)) {
        Cache::put('user_name' , Auth::guard('laboratory_employees')->user()->name , 3600 );
        Cache::put('user_email' , Auth::guard('laboratory_employees')->user()->email , 3600 );
        return redirect()->route('dashboard.laboratory_employee');
    }

    return redirect()->back()->withErrors(trans('Dashboard/auth.failed'));
    }

    public function destroy(Request $request)
    {
        //
        Auth::guard('laboratory_employees')->logout();
        Cache::forget('user_name');
        Cache::forget('user_email');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
