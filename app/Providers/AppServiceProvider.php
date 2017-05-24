<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Enable CORS
        // In production, replace * with http://yourdomain.com
        /*
        header("Access-Control-Allow-Origin: http://localhost:8080");
        header('Access-Control-Allow-Credentials: true');

        if (request()->getMethod() == "OPTIONS") {
            header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
            header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, X-Auth-Token, Origin, Authorization, x-xsrf-token");
        }
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
