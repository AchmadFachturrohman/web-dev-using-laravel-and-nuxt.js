<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //
    public function index(){
        $employees = Employee::with(['golongan', 'jabatan'])->get();

        if ($employees->count() > 0) {
            $employees = $employees->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'nip' => $employee->nip ?? "",
                    'name' => $employee->name ?? "",
                    'city_of_birth' => $employee->city_of_birth ?? "",
                    'address' => $employee->address ?? "",
                    'birth_date' => $employee->born_date ?? "",
                    'gender' => $employee->gender,
                    'golongan' => $employee->golongan->name ?? 'Unknown',
                    'eselon' => $employee->golongan->eselon ?? '-',
                    'jabatan' => $employee->jabatan->name ?? "",
                    'duty_loc' => $employee->duty_loc ?? "",
                    'religion' => $employee->religion,
                    'unit_kerja' => $employee->unit_kerja ?? "",
                    'phone_number' => $employee->phone_number ?? "",
                    'npwp' => $employee->npwp ?? "",
                ];
            });

            return response()->json([
                'status' => 200,
                'message' => 'Data Fetched Successfully',
                'data' => $employees
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records Found !'
            ], 404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nip'           => 'nullable|string|max:12',
            'name'          => 'nullable|string|max:255',
            'city_of_birth' => 'nullable|string|max:255',
            'address'       => 'nullable|string|max:255',
            'birth_date'    => 'required|date',
            'gender'        => 'required|string|max:255',
            'gol_id'        => 'required|exists:golongans,id',
            'jabatan_id'    => 'nullable|exists:jabatans,id',
            'duty_loc'      => 'nullable|string|max:255',
            'religion'      => 'required|string|max:255',
            'unit_kerja'    => 'nullable|string|max:255',
            'phone_number'  => 'nullable|digits_between:1,15',
            'npwp'          => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }else {
            $employee = Employee::create([
                'nip'           => $request->nip,
                'name'          => $request->name,
                'city_of_birth' => $request->city_of_birth,
                'address'       => $request->address,
                'birth_date'    => $request->birth_date,
                'gender'        => $request->gender,
                'gol_id'        => $request->gol_id,
                'jabatan_id'    => $request->jabatan_id,
                'duty_loc'      => $request->duty_loc,
                'religion'      => $request->religion,
                'unit_kerja'    => $request->unit_kerja,
                'phone_number'  => $request->phone_number,
                'npwp'          => $request->npwp
            ]);

            if ($employee) {
                return response()->json([
                    'status'    => 200,
                    'message'   => 'Employee Created Successfully',
                    'employee'  => $employee
                ],200);
            }else {
                return response()->json([
                    'status'    => 500,
                    'message'   => 'Something Went Wrong !'
                ],500);
            }
        }
    }

    public function getById($Id){
        $employee = Employee::find($Id);

        if ($employee) {
            return response() -> json([
                'status' => 200,
                'message' => 'Data Fetched Successfully',
                'data' => $employee
            ], 200);
        }else {
            return response() -> json([
                'status' => 404,
                'message' => 'No Such Employee Found !'
            ], 404);
        }
    }

    public function update(Request $request, int $Id){        
        $validator = Validator::make($request->all(), [
            'nip'           => 'nullable|string|max:12',
            'name'          => 'nullable|string|max:255',
            'city_of_birth' => 'nullable|string|max:255',
            'address'       => 'nullable|string|max:255',
            'birth_date'    => 'required|date',
            'gender'        => 'required|string|max:255',
            'gol_id'        => 'required|exists:golongans,id',
            'jabatan_id'    => 'nullable|exists:jabatans,id',
            'duty_loc'      => 'nullable|string|max:255',
            'religion'      => 'required|string|max:255',
            'unit_kerja'    => 'nullable|string|max:255',
            'phone_number'  => 'nullable|digits_between:1,15',
            'npwp'          => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }else {
            $employee = Employee::find($Id);           

            if ($employee) {
                $employee -> update([
                    'nip'           => $request->nip,
                    'name'          => $request->name,
                    'city_of_birth' => $request->city_of_birth,
                    'address'       => $request->address,
                    'birth_date'    => $request->birth_date,
                    'gender'        => $request->gender,
                    'gol_id'        => $request->gol_id,
                    'jabatan_id'    => $request->jabatan_id,
                    'duty_loc'      => $request->duty_loc,
                    'religion'      => $request->religion,
                    'unit_kerja'    => $request->unit_kerja,
                    'phone_number'  => $request->phone_number,
                    'npwp'          => $request->npwp
                ]);

                return response()->json([
                    'status'    => 200,
                    'message'   => 'Employee Updated Successfully',
                    'employee'  => $employee
                ],200);
            }else {
                return response()->json([
                    'status'    =>  404,
                    'message'   => 'No Such Employee Found !'
                ], 404);
            }
        }
    }

    public function destroy($Id){
        $employee = Employee::find($Id);
        if ($employee) {
            $employee -> delete();
            return response()->json([
                'status'    => 200,
                'message'   => 'Employee Deleted Successfully'
            ],200);
        }else {
            return response()->json([
                'status'    =>  404,
                'message'   => 'No Such Employee Found !'
            ], 404);
        }
    }

    public function filterByJabatan($jabatanId)
    {
        $employees = Employee::where('jabatan_id', $jabatanId)->get();

        if ($employees->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => 'Data Fetched Successfully',
                'data' => $employees
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records Found !'
            ], 404);
        }
    }

    public function search(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('name')) {
            $name = strtolower($request->input('name'));
            $query->orWhereRaw('LOWER(name) LIKE ?', ['%' . $name . '%']);
        }

        if ($request->filled('nip')) {
            $query->orWhere('nip', 'like', '%' . $request->input('nip') . '%');
        }

        if ($request->filled('npwp')) {
            $query->orWhere('npwp', 'like', '%' . $request->input('npwp') . '%');
        }

        $employees = $query->get();

        if ($employees->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => 'Data Fetched Successfully',
                'data' => $employees
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records Found !'
            ], 404);
        }
    }
}