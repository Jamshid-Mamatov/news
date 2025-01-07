<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;


class AuthController extends Controller
{
    //

    public function register(RegisterUserRequest $request, UserService $userService){
        $validatedData=$request->validated();

        $user = $userService->registerUser($validatedData);

        return response()->json(['user' => $user], 201);
    }


    public function login(LoginUserRequest $request){


        $credentials=$request->validated();

        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user =Auth::user();
        Log::info("user",[$user]);
        
        $token = $user->createToken("Api token")->plainTextToken;
        Log::error("token",[$token]);
        return response()->json(['token' => $token], 200);

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
