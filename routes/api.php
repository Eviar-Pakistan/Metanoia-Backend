<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\SingleApiController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PatientController;

// forgot password
Route::post('/forgot-password', [AuthenticateController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthenticateController::class, 'resetPassword']);
// Other routes that do not require authentication can be placed outside the group
Route::post('/login', [AuthenticateController::class, 'login']);
Route::post('/signup', [AuthenticateController::class, 'signup']);

// Route::post('/subscription', [SubscriptionController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/verify-email', [AuthenticateController::class, 'verifyEmail']);
    Route::post('/verify-otp', [AuthenticateController::class, 'verifyOtp']);
    Route::post('/update-profile', [AuthenticateController::class, 'updateProfile']);

    Route::controller(SingleApiController::class)->group(function () {
        Route::get('category/{id?}', 'category_index');
        Route::get('subscription/{id?}', 'subscription_index');
        Route::get('videos/{id?}', 'video_index');
        Route::get('assign_subscription/{id}', 'assign_subscription');
        Route::get('video_sessions', 'get_video_sessions');
        Route::get('video_play/{id}', 'video_play');
        Route::get('user', 'current_user');
        Route::get('question_get', 'question_get');
        Route::post('increment_option', 'incrementOption');
        Route::post('deivce_connected', 'deivce_connected');
        Route::post('device_disconnected', 'device_disconnected');
        Route::post('video_running', 'video_running');
        Route::post('video_completed', 'video_completed');
        Route::post('mobile_video_running', 'mobile_video_running');
        // subscription url
        Route::get('subscription_redirect', 'getEncodedUrl');
    });


    // Manager routes for frontend API calls
    Route::get('/managers', [ManagerController::class, 'getAllManagers'])->middleware('auth:sanctum');
    Route::post('/managers', [ManagerController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/managers/{manager}', [ManagerController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/managers/{manager}', [ManagerController::class, 'destroy'])->middleware('auth:sanctum');


    // Patient

    Route::post('/patient', [PatientController::class, 'store'])->middleware('auth:sanctum');
    Route::put('/patient/{patient}', [PatientController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/patient/{patient}', [PatientController::class, 'destroy'])->middleware('auth:sanctum');
});
