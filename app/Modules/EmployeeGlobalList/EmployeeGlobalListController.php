<?php

namespace App\Modules\EmployeeGlobalList;

use App\Http\Controllers\Controller;
use App\Models\EmployeeGlobal;
use Inertia\Inertia;

class EmployeeGlobalListController extends Controller
{
    public function index()
    {
        $employees = EmployeeGlobal::all();
        return Inertia::render('EmployeeGlobalList/index', [
            'employees' => $employees,
        ]);
    }
}
