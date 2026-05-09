<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email'    => 'required|email|unique:accounts,email',
            'username' => 'required|string|unique:accounts,username|max:50',
            'password' => 'required|min:6',
            'role'     => 'in:client,mentor',
        ]);

        $account = Account::create([
            'fullname' => $request->fullname,
            'email'    => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role ?? 'client',
        ]);

        $token = $account->createToken('flutter')->plainTextToken;

        return response()->json([
            'success' => true,
            'token'   => $token,
            'data'    => [
                'id'       => $account->id,
                'fullname' => $account->fullname,
                'email'    => $account->email,
                'username' => $account->username,
                'role'     => $account->role,
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $account = Account::where('email', $request->email)->first();

        if (!$account || !Hash::check($request->password, $account->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        $token = $account->createToken('flutter')->plainTextToken;

        return response()->json([
            'success' => true,
            'token'   => $token,
            'data'    => [
                'id'       => $account->id,
                'fullname' => $account->fullname,
                'email'    => $account->email,
                'username' => $account->username,
                'role'     => $account->role,
            ]
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'data'    => $request->user()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out'
        ]);
    }
}