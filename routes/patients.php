<?php

use App\Http\Controllers\LaboratoryEmployee\InvoiceController;
use App\Http\Controllers\Patient\PatientDashboardController;
use App\Http\Controllers\Patient\PaymentController;
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

        //########################## Dashboard patients ##########################
        Route::get('/dashboard/patients', function () {
            return view('Dashboard.Patient.dashboard');
        })->middleware(['auth:patients'])->name('dashboard.patients');
        //########################## End Dashboard patients ##########################

        // -------------------------------------------------------------------------------

    Route::middleware(['auth:patients'])->group(function (){
        Route::prefix('patients')->group(function (){

            Route::get('patient_invoices' , [PatientDashboardController::class , 'invoices'])->name('patient.invoices');
            Route::get('patient_laboratories' , [PatientDashboardController::class , 'laboratories'])->name('patient.laboratories');
            Route::get('patient_viewLaboratory/{id}' , [PatientDashboardController::class , 'viewLaboratory'])->name('patient.viewLaboratory');
            Route::get('patient_rays' , [PatientDashboardController::class , 'rays'])->name('patient.rays');
            Route::get('patient_viewRay/{id}' , [PatientDashboardController::class , 'viewRay'])->name('patient.viewRay');
            Route::get('patient_payments' , [PatientDashboardController::class , 'payments'])->name('patient.payments');
            // Route::get('patient_pay' , [PaymentController::class , 'payment'])->name('patient.pay');

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });
        });
    });

    });


