<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\EDIController;
use App\Http\Controllers\ClientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/register', function (Request $request) {
//     $validatedData = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|unique:users|max:255',
//         'password' => 'required|string|min:8|confirmed',
//     ]);

//     $user = new User();
//     $user->name = $validatedData['name'];
//     $user->email = $validatedData['email'];
//     $user->password = Hash::make($validatedData['password']);
//     $user->save();

//     return response()->json(['message' => 'User created successfully'], 201);
// });


// Route::post('/login', function (Request $request) {
//     $credentials = $request->only('email', 'password');

//     if (! $token = Auth::attempt($credentials)) {
//         return response()->json(['error' => 'Unauthorized'], 401);
//     }

//     return response()->json(['token' => $token]);
// });


Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    // Route::post('logout', 'logout');
    // Route::post('refresh', 'refresh');

});

Route::post('/roles', [RolesController::class, 'store'])->name('create.roles');
Route::post('edi', [EDIController::class, 'store'])->name('create.edi');
Route::get('edi', [EDIController::class, 'fetchEdis'])->name('get.edis');
Route::post('client', [ClientController::class, 'store'])->name('create.cleint');
Route::get('client', [ClientController::class, 'fetchClients'])->name('get.clients');

Route::get('/search-client/{id}', [ClientController::class, 'searchClient']);

Route::get('/export_client_pdf/{id}', [ClientController::class, 'exportClientToPDF'])->name('export.client');
