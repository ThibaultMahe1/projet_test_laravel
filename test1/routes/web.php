<?php


use App\Http\Controllers\UniversController;
use App\Http\Controllers\UserController;
use App\Models\Univers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('univers', UniversController::class)->parameters(['univers' => 'univers']);


Route::get('/', [UniversController::class , 'index'])->name('/');
Route::get('/logout', [UserController::class, 'logout']);


