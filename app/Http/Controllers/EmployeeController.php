<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index() {
        Cache::remember('employees', 60, function() {
            return Employee::all();
        });
        $employees = Cache::get( 'employees' );
        return Datatables::of($employees)
            ->addColumn('action', function ($employee) {
                return "<div class='btn-group btn-group-sm'>
                                <button type='button' class='btn btn-info edit mr-1' >
                                    <i class='fa fa-pencil-square-o'></i>
                                </button>
                                <button type='button' class='btn btn-danger delete' data-url='/employees/$employee->id'
                                 data-table='employees-table'>
                                    <i class='fa fa-trash'></i>
                                </button>
                            </div>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addOrUpdate(Request $request) {
        $request->validate([
            'name' => 'required',
        ], ['name.required' => 'Name is required']);

        $data = $request->only(['name', 'email', 'phone_no', 'address']);
        if ($request->id) {
            Employee::whereId($request->id)->update($data);
        } else {
            Employee::create($data);
        }
        Cache::forget('employees');
        return back();
    }

    public function delete ($id) {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        Cache::forget('employees');
        return response()->json(['status' => true, 'message' => 'Employee deleted']);
    }

}
