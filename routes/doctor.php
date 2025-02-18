<?php

use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Doctor\DiagnosticController;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Doctor\laboratoryController;
use App\Http\Controllers\Doctor\PatientDetailsController;
use App\Http\Controllers\Doctor\RayController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ LocaleSessionRedirect::class, LaravelLocalizationRedirectFilter::class, LaravelLocalizationViewPath::class ]
    ], function(){

        //########################## Dashboard Doctor ##########################
        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.Doctor.dashboard');
        })->middleware(['auth:doctors'])->name('dashboard.doctor');
        //########################## End Dashboard Doctor ##########################

        // -------------------------------------------------------------------------------

    Route::middleware(['auth:doctors'])->group(function (){
        Route::prefix('doctor')->group(function (){
            Route::resource('invoices' , InvoiceController::class);
            Route::resource('diagnosis' , DiagnosticController::class);
            Route::post('addReview' , [DiagnosticController::class , 'addReview'])->name('addReview');
            Route::resource('rays' , RayController::class);
            Route::resource('patient_details' , PatientDetailsController::class);
            Route::resource('laboratories' , laboratoryController::class);
            Route::get('showLaboratory/{id}' , [laboratoryController::class , 'showLaboratory'])->name('showLaboratory');

            Route::get('completedInvoices' , [InvoiceController::class , 'completedInvoices'])->name('completedInvoices');
            Route::get('reviewInvoices' , [InvoiceController::class , 'reviewInvoices'])->name('reviewInvoices');
            Route::get('patient_details' , [PatientController::class , 'getInvoice'])->name('patient_details');

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });
        });
    });

    });





