<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Semester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::resource('/courses', 'CourseController')->middleware('auth');
Route::get('/courses',[CourseController::class,'index'])->middleware('auth')->middleware('onlyadmin');
Route::post('/courses',[CourseController::class,'store'])->middleware('auth')->middleware('onlyadmin');
Route::put('/courses/{id}',[CourseController::class,'update'])->middleware('auth')->middleware('onlyadmin');
Route::get('/student', [App\Http\Controllers\HomeController::class, 'getStudent'])->middleware('auth');

Route::get('/semesters',[Semester::class,'index'])->middleware('auth');
Route::delete('/courses/{id}',[CourseController::class,'destroy'])->middleware('auth')->middleware('onlyadmin');
Route::post('/semesters',[Semester::class,'store'])->middleware('auth')->middleware('onlyadmin');



