<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;

// Route::post('/register', function (Request $request) {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users',
//         'password' => 'required|min:8',
//     ]);

//     $user = User::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'password' => Hash::make($request->password),
//     ]);

//     return response()->json(['user' => $user], 201);
// });

// Route::post('/login', function (Request $request) {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     $user = User::where('email', $request->email)->first();

//     if (! $user || ! Hash::check($request->password, $user->password)) {
//         return response()->json(['message' => 'Invalid credentials'], 401);
//     }

//     $token = $user->createToken('API Token')->plainTextToken;

//     return response()->json(['token' => $token], 200);
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Authenticated routes

Route::prefix("auth") -> group(function (){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/user',[AuthController::class,'user'])->middleware('auth:sanctum');
    Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
});

