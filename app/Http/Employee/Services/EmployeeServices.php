<?php

namespace App\Http\Employee\Services;

use App\Http\Employee\Repositories\EmployeeRepository;
use Yajra\DataTables\Facades\DataTables;

class EmployeeServices 
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new EmployeeRepository();
    }

    public function getEmployees()
    {
        $employees = $this->repository->getEmployees();
        
            return Datatables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                   $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editEmployee">Edit</a>';

                   $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEmployee">Delete</a>';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function getEmployee($id)
    {
        if (isset($id)) {
            $employee = $this->repository->getEmployee($id);
            
            return response()->json([
                'success' => true,
                'data' => $employee,
            ]);
        }
        return response()->json([
            'success' => false,
            'errorMsg' => "id is required"
        ]);
    }

    public function delete($id)
    {
        if (isset($id)) {
            $employee = $this->repository->getEmployee($id);
            $employee->delete();

        return response()->json(['success' => 'Employee deleted successfully.']);
           
        }
        return response()->json([
            'success' => false,
            'errorMsg' => "id is required"
        ]);
    }
}
