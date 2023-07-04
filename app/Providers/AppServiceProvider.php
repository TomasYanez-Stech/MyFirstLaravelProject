<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facade\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /* 
        // Cambiar rutas al español
        Route::resourceVerbs([
            "create" => "crear",
            "edit" => "editar"
        ]);
        */
    }
}
