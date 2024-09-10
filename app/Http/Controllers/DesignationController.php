<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        $designation = Designation::paginate(20);
        return response()->json($designation);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $designation = Designation::create($request->all());
        return response()->json([
            'message' => 'Designation Inserted Successfully !!!',
            'data' => $designation
        ],201);
    }

    public function update(Request $request, $id)
    {
        $designation = Designation::findOrFail($id);
        $update = $designation->update($request->all());
        return response()->json([
            'message' => 'Designation Updated successfully !!!',
            'data' => $update
        ]);
    }

    public function destroy($id)
    {
        Designation::destroy($id);
        return response()->json([
            'message' => 'Designation deleted Successfully !!!'
        ]);
    }
}
