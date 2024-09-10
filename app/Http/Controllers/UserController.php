<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('department', 'designation');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%")
                  ->orWhereHas('department', function($q) use ($searchTerm) {
                      $q->where('title', 'like', "%{$searchTerm}%");
                  })
                  ->orWhereHas('designation', function($q) use ($searchTerm) {
                      $q->where('title', 'like', "%{$searchTerm}%");
                  });
            });
        }

        $users = $query->paginate(10); // Paginate results

        return response()->json($users);
    }
}
