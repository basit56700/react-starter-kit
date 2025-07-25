<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Modules\EmployeeGlobalList\EmployeeGlobalListController;


Route::resource('/employee_global_list', EmployeeGlobalListController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

