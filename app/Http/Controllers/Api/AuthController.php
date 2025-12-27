<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * REGISTER USER
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'type' => 'in:admin,user'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type ?? 'user'
        ]);

        $abilities = $user->type === 'admin'
            ? ['products:manage', 'users:manage', 'orders:manage']
            : ['products:view'];

        $token = $user->createToken('api-token', $abilities)->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token,
            'role' => $user->type
        ], 201);
    }

    /**
     * LOGIN USER
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $abilities = $user->type === 'admin'
            ? ['products:manage']
            : ['products:view'];

        $token = $user->createToken('api-token', $abilities)->plainTextToken;

        return response()->json([
            'token' => $token,
            'role' => $user->type
        ], 200);
    }
}
