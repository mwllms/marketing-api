<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'Kan niet inloggen met deze gegevens.'
            ], 422);
        }

        return response()->json([
            'token' => $token
        ], 200);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'data' => $user::with('roles')->get()
        ], 200);
    }

    public function assignRole(Request $request)
    {
        $this->validate($request, [
            'role' => 'required'
        ]);

        $user = $request->user();
        $user->assignRole($request->role);
       
        return response()->json([
            'data' => $user
        ], 200);
    }
}
