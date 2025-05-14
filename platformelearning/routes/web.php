<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Formateur\FormateurDashboardController;
use App\Http\Controllers\Apprenant\ApprenantDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Page publique
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentification (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Route générique /dashboard → redirection par rôle
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();

    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'formateur':
            return redirect()->route('formateur.dashboard');
        case 'apprenant':
        default:
            return redirect()->route('apprenant.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Espace Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
         Route::get('/dashboard', [AdminDashboardController::class, 'index'])
              ->name('dashboard');
         // → autres routes admin…
     });

/*
|--------------------------------------------------------------------------
| Espace Formateur
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:formateur'])
     ->prefix('formateur')
     ->name('formateur.')
     ->group(function () {
         Route::get('/dashboard', [FormateurDashboardController::class, 'index'])
              ->name('dashboard');
         // → autres routes formateur…
     });

/*
|--------------------------------------------------------------------------
| Espace Apprenant
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:apprenant'])
     ->prefix('apprenant')
     ->name('apprenant.')
     ->group(function () {
         Route::get('/dashboard', [ApprenantDashboardController::class, 'index'])
              ->name('dashboard');
         // → autres routes apprenant…
     });

/*
|--------------------------------------------------------------------------
| Profil utilisateur
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Vérification d'email
|--------------------------------------------------------------------------
*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth','signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status','Lien de vérification envoyé !');
})->middleware(['auth','throttle:6,1'])->name('verification.send');
