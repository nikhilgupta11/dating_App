<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    AuthController,
    SettingController,
};

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

Route::controller(AuthController::class)->middleware(['api'])->prefix('v1/auth')->group(function () {
    Route::post('/register', 'register');

    Route::post('/login', 'login');
    Route::post('/otp-verify/{user_id}', 'verify_otp');

    // google
    Route::get('authorized/google',  'redirectToGoogle');
    Route::get('authorized/google/callback', 'handleGoogleCallback');

    // facebook
    Route::get('auth/facebook', 'redirectToFacebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');

    // apple

    // forgot password
    Route::post('/forgot-password', 'forgot_password');
});

Route::middleware(['api'])->prefix('v1')->group(function () {
    Route::controller(SettingController::class)->group(function () {
        Route::get('/setting', 'setting');
    });
});
