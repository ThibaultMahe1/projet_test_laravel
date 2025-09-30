<?php

use App\Http\Controllers\UniversController;
use App\Http\Controllers\UserController;
use App\Models\Univers;
use Illuminate\Support\Facades\Route;

Route::get('/', [UniversController::class , 'index']);
Route::get('/connection',  function(){return view('connection.connection');});
Route::get('/cree',  function(){return view('connection.creation');});
Route::get('/modif',  function(){return view('connection.modifier');});
Route::get('/logout', [UserController::class, 'logout']);

Route::resource('univers', UniversController::class)->parameters(['univers' => 'univers']);

Route::post('/creat', [UserController::class, 'create']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/Modification', [UserController::class, 'modif']);
