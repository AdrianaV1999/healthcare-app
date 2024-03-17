<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\BloodPressureMeasurementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeightMeasurementController;
use App\Http\Controllers\SleepHourController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\TerminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LekoviController;
use App\Http\Controllers\DoctorController;

Route::post('register',[AuthController::class,'register']);

Route::post('login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/chekingAuthenticated',function () {
return response()->json(['message'=>'You are in', 'status'=>200],200);
    });
    
Route::post('logout', [AuthController::class,'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('blood-pressure-measurements', [BloodPressureMeasurementController::class, 'store']);
    Route::get('blood-pressure-measurements/previous', [BloodPressureMeasurementController::class, 'getPreviousMeasurements']);

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('profile', [ProfileController::class, 'store']);
    Route::get('profile/data', [ProfileController::class, 'getData']);

});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('weight-measurements', [WeightMeasurementController::class, 'store']);
    Route::get('all-weight-measurements', [WeightMeasurementController::class, 'index']);
    Route::get('weight-current', [WeightMeasurementController::class, 'getWeightMeasurementsForCurrentUser']);

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('sleep-hours', [SleepHourController::class, 'store']);
    Route::get('all-sleep-hours', [SleepHourController::class, 'index']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/activity', [ActivityController::class, 'store']);
    Route::get('/activities', [ActivityController::class, 'index']);
    Route::get('/activitiescurrent', [ActivityController::class, 'getPreviousActivities']);

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/nutrition', [NutritionController::class, 'store']);
    Route::get('/nutritions', [NutritionController::class, 'index']);
    Route::get('/nutritionscurrent', [NutritionController::class, 'getNutritionForCurrentUser']);


});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/zakazi-termin', [TerminController::class, 'store']);
    Route::get('/lekari/{lekar}/termini', [TerminController::class, 'terminiZaLekara']);
    Route::post('/termini/{termin}/prihvati', [TerminController::class, 'prihvatiTermin']);
    Route::post('/termini/{termin}/odbij', [TerminController::class, 'odbijTermin']);
    Route::get('/moji-termini', [TerminController::class, 'mojiTermini']);
    Route::get('/lekari/{lekar}/termini-prihvaceni', [TerminController::class, 'terminiPrihvaceniZaLekara']);



});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/role-zero', [UserController::class, 'getUsersWithRoleZero']);



});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/lekovi', [LekoviController::class, 'store']);
    Route::get('/mojilekovi', [LekoviController::class, 'index']);



});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/usersadd', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/deleteusers/{id}', [UserController::class, 'destroy']);
    Route::get('/users/search/{keyword}', [UserController::class, 'search']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/profiles', [ProfileController::class, 'store']); 
    Route::get('/allprofiles', [ProfileController::class, 'getAllProfiles']); 
    Route::put('/profiles/{id}', [ProfileController::class, 'update']); 
    Route::delete('/deleteprofiles/{id}', [ProfileController::class, 'delete']); 
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/doctors', [DoctorController::class, 'store']);
    Route::get('/alldoctors', [DoctorController::class, 'index']);
    Route::delete('/delete/doctors/{id}', [DoctorController::class, 'delete']);
    Route::put('/update/doctors/{id}', [DoctorController::class, 'update']);
    Route::get('/currentDoctor', [DoctorController::class, 'vratiLekara']);

});
