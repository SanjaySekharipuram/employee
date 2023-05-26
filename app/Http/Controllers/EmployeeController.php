<?php

namespace App\Http\Controllers;

use App\Http\Employee\Services\EmployeeServices;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new EmployeeServices();
    }

    public function employeeIndex()
    {
        $genderOptions = [
            1 => 'Male',
            2 => 'Female',
            3 => 'Other',
        ];

        return view('employee\index', compact('genderOptions'));
    }

    public function getEmployees()
    {
        return $this->service->getEmployees();
    }
    public function getEmployee($id)
    {
        return $this->service->getEmployee($id);
        
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name'  =>  'required',
            'email' => [
                'required',
                'email',
                Rule::unique('employees')->ignore($request->employee_id),
            ],
            'phone' => 'digits:10'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json([
                'success' => false,
                'errorMessage' => $error,
            ]);
        }


        Employee::updateOrCreate(
            ['id' => $request->employee_id],
            [
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
            ]
        );

        return response()->json([
            'success' => true
        ]);
    }

    public function delete($id)
    {
        return $this->service->delete($id);

    }
}
