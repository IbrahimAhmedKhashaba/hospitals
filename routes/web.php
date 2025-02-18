<?php

use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RayEmployee\InvoiceController;
use App\Http\Controllers\WebSite\WebSiteController;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ LocaleSessionRedirect::class, LaravelLocalizationRedirectFilter::class, LaravelLocalizationViewPath::class ]
    ], function(){
        Route::get('/', [WebSiteController::class , 'index']);

        Route::get('markAsRead/{guard}', [NotificationController::class, 'markAsRead'])->name('markAsRead');

    });

Route::resource('invoices' , InvoiceController::class);


require __DIR__.'/patients.php';
require __DIR__.'/laboratory_employees.php';
require __DIR__.'/ray_employees.php';
require __DIR__.'/doctor.php';
require __DIR__.'/Backend.php';

Route::get('404', function () {
    return view('Dashboard.404');
})->name('404');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


