<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::paginate(10);
        return response()->json($department);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $department = Department::create($request->all());
        return response()->json([
            'message' => 'Department Created Successfully !!!',
            'data' => $department
        ],201);
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $department = $department->update($request->all());
        return response()->json([
            'message' => 'Dapartment Updated Successfully !!!',
            'data' => $department
        ],201);
    }

    public function destroy($id)
    {
        Department::destroy($id);
        return response()->json([
            'message' => 'Department Deleted Successfully !!!',
        ]);
    }
}
