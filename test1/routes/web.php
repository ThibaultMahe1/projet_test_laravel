<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UniversController;
use App\Http\Controllers\UserController;
use App\Mail\infomail;
use Illuminate\Support\Facades\Route;

// use App;
Route::middleware('LangLocale')->group(function () {

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

    Route::get('/lang/{locale}', function ($locale) {
        //  dd($locale);
        if (in_array($locale, ['en', 'fr'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        return redirect()->back();
    });

    Route::get('/mail', function () {
        Mail::to('destinataire@example.com')->send(new infomail);

    });
    Route::get('/', [UniversController::class, 'index'])->name('/');
    Route::get('/logout', [UserController::class, 'logout']);
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

});
