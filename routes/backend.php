<?php

use App\Http\Controllers\Dashboard\BookingController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\LaboratoryEmployeeController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Middleware\Auth\AdminMiddleware;
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

        // Route::get('/' , [DashboardController::class , 'index'])->middleware(['auth']);

        //########################## Dashboard User ##########################
        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');
        })->middleware(AdminMiddleware::class)->name('dashboard.user');
        //########################## End Dashboard User ##########################


        //########################## Dashboard Admin ##########################
        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admins'])->name('dashboard.admin');
        //########################## End Dashboard Admin ##########################

        // -------------------------------------------------------------------------------
        Route::view('single_invoices' , 'livewire.SingleInvoices.index')->name('single_invoices');

        Route::middleware(AdminMiddleware::class)->group(function (){
            Route::resource('sections' , SectionController::class);
            Route::resource('doctors' , DoctorController::class);
            Route::resource('insurances' , InsuranceController::class);
            Route::put('ambulances/{id}' , [AmbulanceController::class , 'update'])->name('ambulances.update');
            Route::resource('ambulances' , AmbulanceController::class);
            Route::resource('bookings' , BookingController::class);
            Route::resource('patients' , PatientController::class);
            Route::resource('receipts' , ReceiptAccountController::class);
            Route::resource('payments' , PaymentAccountController::class);
            Route::resource('ray_employees' , RayEmployeeController::class);
            Route::resource('laboratory_employees' , LaboratoryEmployeeController::class);
            Route::put('doctors/update_password/{id}' , [DoctorController::class , 'update_password'])->name('doctors.update_password');
            Route::put('doctors/update_status/{id}' , [DoctorController::class , 'update_status'])->name('doctors.update_status');
            Route::resource('services' , SingleServiceController::class);
            Route::view('Add_GroupServices' , 'livewire.GroupServices.include_create')->name('Add_GroupServices');
            Route::view('group_invoices' , 'livewire.GroupInvoices.index')->name('group_invoices');
            Route::view('Print_group_invoices' , 'livewire.GroupInvoices.print')->name('Print_group_invoices');
            Route::view('single_invoices' , 'livewire.SingleInvoices.index')->name('single_invoices');
            Route::view('Print_single_invoices' , 'livewire.SingleInvoices.print')->name('Print_single_invoices');
            Route::get('patient/{id}' , [PaymentAccountController::class , 'get_amount'])->name('get_amount');

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });
        });





        require __DIR__.'/auth.php';
    });





