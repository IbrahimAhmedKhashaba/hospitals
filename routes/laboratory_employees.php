<?php

use App\Http\Controllers\LaboratoryEmployee\InvoiceController;
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

        //########################## Dashboard Laboratory Employee ##########################
        Route::get('/dashboard/laboratory_employees', function () {
            return view('Dashboard.LaboratoryEmployee.dashboard');
        })->middleware(['auth:laboratory_employees'])->name('dashboard.laboratory_employee');
        //########################## End Dashboard Laboratory Employee ##########################

        // -------------------------------------------------------------------------------

    Route::middleware(['auth:laboratory_employees'])->group(function (){
        Route::prefix('laboratory_employees')->group(function (){

            Route::resource('invoices_laboratory_employee' , InvoiceController::class);
            Route::get('completedInvoices_laboratory_employee' , [InvoiceController::class , 'completedInvoices'])->name('completedInvoices_laboratory_employee');
            Route::get('viewLaboratories_laboratory_employee/{id}' , [InvoiceController::class , 'viewLaboratories'])->name('viewLaboratories_laboratory_employee');

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });
        });
    });

    });


