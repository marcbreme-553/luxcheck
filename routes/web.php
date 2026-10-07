<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\MediaController;

/*
|--------------------------------------------------------------------------
| Startseite
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Registrierung
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| Nur für eingeloggte Benutzer
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/items', [ItemController::class, 'index']);

    Route::get('/items/create', [ItemController::class, 'create']);

    Route::post('/items', [ItemController::class, 'store']);

    Route::get('/items/{item}', [ItemController::class, 'show']);

    Route::get('/items/{item}/edit', [ItemController::class, 'edit']);

    Route::patch('/items/{item}', [ItemController::class, 'update']);

    Route::delete('/items/{item}', [ItemController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    Route::get('/items/{item}/checks/create', [CheckController::class, 'create']);

    Route::post('/items/{item}/checks', [CheckController::class, 'store']);

    Route::post('/items/{item}/ai-check', [CheckController::class, 'aiCheck']);

    Route::get('/items/{item}/media/create', [MediaController::class, 'create']);

    Route::get('/items/{item}/media/create', [MediaController::class, 'create']);

    Route::post('/items/{item}/media', [MediaController::class, 'store']);
});
