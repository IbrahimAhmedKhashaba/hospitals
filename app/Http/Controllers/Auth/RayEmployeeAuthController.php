<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class RayEmployeeAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminLoginRequest $request)
    {
        //
        $credentials = $request->only('email', 'password');

    if (auth('ray_employees')->attempt($credentials)) {
            Cache::put('user_name' , Auth::guard('ray_employees')->user()->name , 3600 );
            Cache::put('user_email' , Auth::guard('ray_employees')->user()->email , 3600 );
        return redirect()->route('dashboard.ray_employees');
    }

    return redirect()->back()->withErrors(trans('Dashboard/auth.failed'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        Auth::guard('ray_employees')->logout();
        Cache::forget('user_name');
        Cache::forget('user_email');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
