<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
{
    //
    public $successStatus = 200;

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string',
            //'remember_me' => 'boolean'
        ]);
        $credentials = request(['username', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        } else {
            $user = $request->user();
            if ($user->hasRole($request->role)) {
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                $token->save();
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString()
                ]);
            } else {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
