<?php

namespace App\Modules\EmployeeGlobalList;

use Illuminate\Routing\Controller;
use Inertia\Inertia;

class EmployeeGlobalListController extends Controller
{
    public function index()
    {
        return Inertia::render('EmployeeGlobalList/Index');
    }
}