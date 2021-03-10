<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SettingAdmin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        return view()->share(['setting' => SettingAdmin::latest()->first()]);
    }
}
