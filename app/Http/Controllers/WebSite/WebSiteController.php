<?php

namespace App\Http\Controllers\WebSite;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Section;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebSiteController extends Controller
{
    //
    public function index(){
        $sections = Cache::remember('sections', 3600 , function(){
            return Section::with(['translations' , 'doctors.translations' , 'invoices'])->get();
        });
        $doctors = Cache::remember('doctors', 3600 , function(){
            return Doctor::with(['translations', 'section.translations', 'image', 'appointments.translations'])->get();
        });
        $doctors_count = Cache::remember('doctors_count', 3600 , function(){
            return Doctor::count();
        });
        $patients_count = Cache::remember('patients_count', 3600 , function(){
            return Patient::count();
        });
        $sections_count = Cache::remember('sections_count', 3600 , function(){
            return Section::count();
        });
        $settings = Cache::remember('settings', 3600 , function(){
            return Setting::first();
        });
        return view('welcome' , compact([
            'sections',
            'sections_count',
            'doctors',
            'doctors_count',
            'patients_count',
            'settings',
        ]));
    }
}
