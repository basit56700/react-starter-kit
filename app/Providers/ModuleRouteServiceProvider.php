<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load all web.php files from app/Modules/*
        foreach (File::glob(app_path('Modules/*/web.php')) as $routeFile) {
            Route::middleware('web')->group($routeFile);
        }
    }
}
