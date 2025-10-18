<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     tags={"Auth"},
     *     summary="Register user baru",
     *     description="Mendaftarkan user baru dengan data name, username, email, dan password.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","username","email","password"},
     *             @OA\Property(property="name", type="string", example="Andika Wiguna"),
     *             @OA\Property(property="username", type="string", example="andika"),
     *             @OA\Property(property="email", type="string", example="andika@mail.com"),
     *             @OA\Property(property="password", type="string", example="secret")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Register success"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Auth"},
     *     summary="Login user",
     *     description="Login menggunakan email dan password untuk mendapatkan token.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="andika@mail.com"),
     *             @OA\Property(property="password", type="string", example="secret")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Login success"),
     *     @OA\Response(response=401, description="Invalid credentials")
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     tags={"Auth"},
     *     summary="Logout user",
     *     description="Menghapus token aktif untuk user yang sedang login.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Logout success"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout success']);
    }

    /**
     * @OA\Get(
     *     path="/api/auth/user",
     *     tags={"Auth"},
     *     summary="Lihat user login",
     *     description="Mengambil data user yang sedang login menggunakan token Sanctum.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Berhasil menampilkan data user"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
