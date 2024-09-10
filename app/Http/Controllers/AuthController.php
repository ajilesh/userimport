<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mail as Email;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class AuthController extends Controller
{
    //user register     
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'phone' => 'required',
            // 'address' => 'required',
            'password' => 'required|string|min:8',
            'department_id' => 'required',
            'designation_id' => 'required'
        ]);
          
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'department_id' => $request->department_id,
            'designation_id' => $request->designation_id,
            'password' => Hash::make($request->password),
        ]);

        $email = Email::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'status' => 'Pending'
        ]);
        
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
            $email->status = 'Sent';
        } catch (\Exception $e) {
            $email->status = 'Failed';
        }
        $email->save();
        return response()->json(['message' => 'User registered successfully.']);
    }
    //user login 
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    //user logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
