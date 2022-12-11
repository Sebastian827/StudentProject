<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/courses',[CourseController::class,'index']);
Route::post('/courses',[CourseController::class,'store']);
Route::put('/courses/{id}',[CourseController::class,'update']);
Route::get('/student', [App\Http\Controllers\HomeController::class, 'getStudent']);
Route::get('/semesters',[Semester::class,'index']);
Route::delete('/courses/{id}',[CourseController::class,'destroy']);
Route::post('/semesters',[Semester::class,'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
