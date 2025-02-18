<?php

use App\Http\Controllers\RayEmployee\InvoiceController;
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
        Route::get('/dashboard/ray_employees', function () {
            return view('Dashboard.RayEmployee.dashboard');
        })->middleware(['auth:ray_employees'])->name('dashboard.ray_employees');
        //########################## End Dashboard Doctor ##########################

        // -------------------------------------------------------------------------------

    Route::middleware(['auth:ray_employees'])->group(function (){
        Route::prefix('ray_employees')->group(function (){

            Route::resource('invoices_ray_employee' , InvoiceController::class);
            Route::get('completedInvoices_ray_employee' , [InvoiceController::class , 'completedInvoices'])->name('completedInvoices_ray_employee');
            Route::get('viewRays_ray_employee/{id}' , [InvoiceController::class , 'viewRays'])->name('viewRays_ray_employee');

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });
        });
    });

    });


