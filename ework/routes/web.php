<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [JobController::class, 'index']);


Route::get('/jobs/{job}', [JobController::class, 'show'])->where('job','[0-9]+');

Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs/create', [JobController::class, 'addJob'])->middleware('auth');


Route::get('/manage', [JobController::class, 'manage'])->middleware('auth');
Route::get('/manage/edit/{id}', [JobController::class, 'edit'])->middleware('auth');
Route::put('/manage/edit/{id}', [JobController::class, 'editJob'])->middleware('auth');


Route::delete('/manage/{id}', [JobController::class, 'delete'])->middleware('auth');



Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name("login");
Route::post('/login', [UserController::class, 'loginUser'])->middleware('guest');

Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/register', [UserController::class, 'registerUser'])->middleware('guest');


Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware('auth');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');



Route::fallback(function() {
    return view("notFound");
});


