<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmployeesExport;

class EmployeeExportController extends Controller
{
    //
    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }
}
