<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\LoginResource;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The credentials are incorrect'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'data' => new LoginResource($user),
            'token' => $user->createToken('token')->plainTextToken
        ], Response::HTTP_OK);
    }
    public function validateToken(Request $request)
    {
        $token = $request->header('Authorization');
        $user = Auth::user();
        return response()->json([
            'data' => new LoginResource($user),
            'token' => $token
        ], Response::HTTP_OK);
    }
}
