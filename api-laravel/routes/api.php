<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('states', [StateController::class, 'all']);
Route::get('states/{id}', [StateController::class, 'get']);
Route::get('cities', [CityController::class, 'all']);
Route::get('cities/{id}', [CityController::class, 'get']);
Route::get('addresses', [AddressController::class, 'all']);
Route::get('addresses/{id}', [AddressController::class, 'get']);
Route::get('users', [UserController::class, 'all']);
Route::get('users/{id}', [UserController::class, 'get']);
Route::post('users', [UserController::class, 'add']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'delete']);
Route::get('userspercity/{cityId}', [UserController::class, 'getByCity']);
Route::get('usersperstate/{stateId}', [UserController::class, 'getByState']);
