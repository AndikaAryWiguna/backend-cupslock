<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    // Register user baru via API
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:10',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Register success',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Login via API
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'user' => $user,
            'token' => $token,
        ]);
    }

    // Logout (hapus token)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout success']);
    }

    // Lihat user login
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
