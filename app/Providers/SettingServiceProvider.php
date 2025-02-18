<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        if(!Setting::count()){
            Setting::create([
                'facebook' => 'facebook',
                'twitter' => 'twitter',
                'gmail' => 'gmail',
                'linkedin' => 'linkedin',
                'skype' => 'skype',
            ]);
        }
    }
}
