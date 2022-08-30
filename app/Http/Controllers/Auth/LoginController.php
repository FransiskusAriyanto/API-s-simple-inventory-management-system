<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (auth()->attempt($validation)) {
            $user = auth()->user();
            $token = $user->createToken($user);
            return response()->json([
                'Data' => new UserResource($user),
                'Token' => $token->plainTextToken,
                'Message' => 'Welcome ' .$user->name,
            ], 201);
        }
    }
}
