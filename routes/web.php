<?php

use App\Http\Controllers\PayPalController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/paypal/cancel', [SubscriptionController::class, 'cancel'])->name('paypal.cancel');
Route::get('/paypal/error', [SubscriptionController::class, 'error'])->name('paypal.error');


Route::get('/dashboard', function () {
    $user = User::count();
    $video = Video::count();
    $category = Category::count();
    return view('dashboard', compact('user', 'video', 'category'));
})->middleware(['auth', 'verified', 'CheckUserRole'])->name('dashboard');

Route::middleware(['auth', 'CheckUserRole'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Controller
    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('user.index');
        Route::get('users/create', 'create')->name('user.create');
        Route::get('users/edit/{id}', 'edit')->name('user.edit');
        Route::get('users/details/{id}', 'video_running')->name('user.details');
        Route::post('users/store', 'store')->name('user.store');
        Route::post('users/update', 'update')->name('user.update');
        Route::post('users/destroy', 'destroy')->name('user.destroy');
    });

    Route::resource('devices', DeviceController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('subscription', SubscriptionController::class);
    Route::resource('videos', VideoController::class);
});

// API-style routes for frontend (protected by Sanctum Bearer token auth)
Route::get('/subscriptions', [SubscriptionController::class, 'getAllSubscriptions'])->middleware('auth:sanctum');
Route::post('/subscription', [SubscriptionController::class, 'store'])->middleware('auth:sanctum');
Route::put('/subscription/{subscription}', [SubscriptionController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/subscription/{subscription}', [SubscriptionController::class, 'destroy'])->middleware('auth:sanctum');


// Catergory 
Route::get('/categories', [CategoryController::class, 'getAllCategories'])->middleware('auth:sanctum');
Route::post('/category', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::put('/category/{category}', [CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');

// Video 
Route::get('/videos', [VideoController::class, 'getAllVideos'])->middleware('auth:sanctum');
Route::post('/video', [VideoController::class, 'store'])->middleware('auth:sanctum');
Route::put('/video/{video}', [VideoController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/video/{video}', [VideoController::class, 'destroy'])->middleware('auth:sanctum');

// PayPal Routes
Route::get('/paypal', [PayPalController::class, 'pay'])->name('paypal');
Route::get('/paypal/success', [PayPalController::class, 'payment_success'])->name('paypal.payment_success');
Route::get('/subscription-plan/{encodedUserId}', [SubscriptionController::class, 'loginAndRedirect']);
Route::get('/subscription/show/{encodedUserId}', [SubscriptionController::class, 'subscription_show'])->name('subscription.show');


// Route::get('/managers', [ManagerController::class, 'getAllManagers'])->middleware('auth:sanctum');

// Department routes for frontend API calls
Route::get('/departments', [DepartmentController::class, 'getAllDepartments'])->middleware('auth:sanctum');
Route::post('/department', [DepartmentController::class, 'store'])->middleware('auth:sanctum');
Route::put('/department/{department}', [DepartmentController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/department/{department}', [DepartmentController::class, 'destroy'])->middleware('auth:sanctum');

// Specialization routes for frontend API calls
Route::get('/specializations', [SpecializationController::class, 'getAllSpecializations'])->middleware('auth:sanctum');
Route::post('/specialization', [SpecializationController::class, 'store'])->middleware('auth:sanctum');
Route::put('/specialization/{specialization}', [SpecializationController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/specialization/{specialization}', [SpecializationController::class, 'destroy'])->middleware('auth:sanctum');

// Hospital routes for frontend API calls
Route::get('/hospitals', [HospitalController::class, 'getAllHospitals'])->middleware('auth:sanctum');
Route::post('/hospital', [HospitalController::class, 'store'])->middleware('auth:sanctum');
Route::put('/hospital/{hospital}', [HospitalController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/hospital/{hospital}', [HospitalController::class, 'destroy'])->middleware('auth:sanctum');

// Doctor routes for frontend API calls
Route::get('/doctors', [DoctorController::class, 'getAllDoctors'])->middleware('auth:sanctum');
Route::post('/doctor', [DoctorController::class, 'store'])->middleware('auth:sanctum');
Route::put('/doctor/{doctor}', [DoctorController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/doctor/{doctor}', [DoctorController::class, 'destroy'])->middleware('auth:sanctum');

// Patient routes for frontend API calls

// Route::post('/patient', [PatientController::class, 'store'])->middleware('auth:sanctum');
// Route::put('/patient/{patient}', [PatientController::class, 'update'])->middleware('auth:sanctum');
// Route::delete('/patient/{patient}', [PatientController::class, 'destroy'])->middleware('auth:sanctum');

// Dashboard Statistics API for frontend
Route::get('/dashboard/statistics', [DashboardController::class, 'getStatistics'])->middleware('auth:sanctum');

// Users API for frontend
Route::get('/users', [UserController::class, 'getAllUsers'])->middleware('auth:sanctum');
Route::post('/user', [UserController::class, 'apiStore'])->middleware('auth:sanctum');
Route::put('/user/{id}', [UserController::class, 'apiUpdate'])->middleware('auth:sanctum');
Route::post('/user/update/{id}', [UserController::class, 'apiUpdate'])->middleware('auth:sanctum');
Route::patch('/user/{id}', [UserController::class, 'apiUpdate'])->middleware('auth:sanctum');
Route::delete('/user/{id}', [UserController::class, 'apiDestroy'])->middleware('auth:sanctum');
Route::post('/user/delete', [UserController::class, 'apiDestroy'])->middleware('auth:sanctum');

Route::get('/managers', [ManagerController::class, 'getAllManagers'])->middleware('auth:sanctum');
Route::post('/managers', [ManagerController::class, 'store'])->middleware('auth:sanctum');
Route::put('/managers/{manager}', [ManagerController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/managers/{manager}', [ManagerController::class, 'destroy'])->middleware('auth:sanctum');


Route::get('/patients', [PatientController::class, 'getAllPatients'])->middleware('auth:sanctum');
Route::post('/patient', [PatientController::class, 'store'])->middleware('auth:sanctum');
Route::put('/patient/{patient}', [PatientController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/patient/{patient}', [PatientController::class, 'destroy'])->middleware('auth:sanctum');

require __DIR__ . '/auth.php';
