<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Models\Planet;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PlanetController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\CrewMemberController;
/*
|--------------------------------------------------------------------------
| Front-office public (maquette)
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('vue.accueil'))->name('accueil');

Route::get('/equipage/{slug?}', [CrewMemberController::class, 'show'])->name('equipage');
Route::get('/technologie', fn () => view('vue.technologie'))->name('technologie');

/*
|--------------------------------------------------------------------------
| Changement de langue (FR / EN)
|--------------------------------------------------------------------------
*/
Route::get('lang/{locale}', function (string $locale) {
    if (in_array($locale, ['fr','en'], true)) {
        Session::put('locale', $locale);
    }
    return back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Dashboard (Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profil (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Back-office Admin (CRUD Planètes & Équipage) — Spatie
|--------------------------------------------------------------------------
*/
// Route::middleware(['auth', 'role:admin|planetManager'])
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
//         Route::resource('planets', PlanetController::class);
//         Route::resource('crew', CrewMemberController::class);
//     });


Route::prefix('admin')->middleware(['auth', 'role:admin|planetManager'])->group(function () {

    Route::resource('planets', PlanetController::class)->names('admin.planets');


    Route::resource('crew', CrewMemberController::class)
        ->names('admin.crew');

});


/*
|--------------------------------------------------------------------------
| Destinations (Public)
|--------------------------------------------------------------------------
| - /destination → affiche la première planète
| - /destination/{slug} → affiche la planète demandée
|--------------------------------------------------------------------------
*/

// 1️⃣ Page destination sans slug → on affiche la 1ère planète
Route::get('/destination', [DestinationController::class, 'index'])
     ->name('destination');

// 2️⃣ Page destination avec slug
Route::get('/destination/{slug}', [DestinationController::class, 'show'])
    ->name('destination.show');

/*
|--------------------------------------------------------------------------
| Routes d’authentification (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
