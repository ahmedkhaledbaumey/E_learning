<?php

namespace App\Providers;

use App\Models\Cat;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    { 
        $cats = Cat::select('id', 'name')->get(); 
        $sett = Setting::select()->first(); 
        View::share('cats', $cats);
        View::share('sett', $sett);
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();    


    }
}
