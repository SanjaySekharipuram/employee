<?php

namespace App\Http\Employee\Repositories;

use App\Models\Employee;

class EmployeeRepository 
{
    public function getEmployees()
    {
        return Employee::all();
    }

    public function getEmployee($id)
    {
        return Employee::findOrFail($id);
    }
}
