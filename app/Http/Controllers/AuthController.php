<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (!$token = JWTAuth::attempt($credentials)) {
    //         return response()->json(['error' => 'Invalid credentials'], 401);
    //     }

    //     return response()->json(['token' => $token]);
    // }

//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|string|email',
//             'password' => 'required|string',
//         ]);
//         $credentials = $request->only('email', 'password');

//         $token = Auth::attempt($credentials);
//         // if (!$token) {
//         //     return response()->json([
//         //         'status' => 'error',
//         //         'message' => 'Unauthorized',
//         //     ], 401);
//         // }


// if($token === false){
//     return response()->json(['error' => 'Unauthorized'], 401);
// }
// // return $this->respondWithToken($token);

//         $user = Auth::user();
//         return response()->json([
//                 'status' => 'success',
//                 'user' => $user,
//                 'authorisation' => [
//                     'token' => $token,
//                     'type' => 'bearer',
//                 ]
//             ]);

//     }


// public function login(Request $request)
// {
//     $credentials = $request->only('email', 'password');

//     if (!Auth::attempt($credentials)) {
//         return response()->json(['error' => 'Unauthorized'], 401);
//     }

//     $user = Auth::user();
//     $token = JWTAuth::fromUser($user);

//     return response()->json([
//         'status' => 'success',
//         'user' => $user,
//         'authorisation' => [
//             'token' => $token,
//             'type' => 'bearer',
//         ]
//     ]);
// }



//     public function register(Request $request){
//         $request->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:6',
//             'role_id' => 'required|string|max:2',
//         ]);

//         $user = User::create([
//             'first_name' => $request->first_name,
//             'last_name' => $request->last_name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'role_id' => $request->role_id,
//         ]);

//         $token = Auth::login($user);
//         return response()->json([
//             'status' => 'success',
//             'message' => 'User created successfully',
//             'user' => $user,
//             'authorisation' => [
//                 'token' => $token,
//                 'type' => 'bearer',
//             ]
//         ]);
//     }

//     public function logout()
//     {
//         try {
//             $token = JWTAuth::parseToken();
//             $token->invalidate();

//             return response()->json(['message' => 'Successfully logged out']);
//         } catch (JWTException $exception) {
//             return response()->json(['message' => 'Failed to log out']);
//         }
//     }



// app/Http/Controllers/Auth/JwtAuthController.php

// app/Http/Controllers/Auth/JwtAuthController.php

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    try {
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    } catch (JWTException $e) {
        return response()->json(['error' => 'Could not create token'], 500);
    }

    $user = Auth::user();

    return response()->json(compact('token', 'user'));
}



    public function logout()
    {
        JWTAuth::invalidate();

        return response()->json(['message' => 'Logged out successfully']);
    }



    public function user()
    {
        return Auth::user();
    }
}

