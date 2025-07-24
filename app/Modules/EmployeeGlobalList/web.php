<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Modules\EmployeeGlobalList\EmployeeGlobalListController;

Route::get('/test-module', fn () => 'Module route working!');


Route::get('/employeegloballist', function () {
        return Inertia::render('EmployeeGlobalList/index');
    })->name('employeegloballist');