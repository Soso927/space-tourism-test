<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Models\Planet;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PlanetController;
use App\Http\Controllers\DestinationController;
/*
|--------------------------------------------------------------------------
| Front-office public (pages maquette)
|--------------------------------------------------------------------------
| Noms de routes : accueil, destination, equipage, technologie
*/
Route::get('/', fn () => view(view: 'vue.accueil'))->name('accueil');
Route::get('/destination', fn () => view('vue.destination'))->name('destination');
Route::get('/equipage', fn () => view('vue.equipage'))->name('equipage');
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
    Route::get('/profile',  [ProfileController::class, 'edit'])   ->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update']) ->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Back-office Admin (CRUD Planètes) — Spatie
|--------------------------------------------------------------------------
| 1) Le groupe /admin est réservé aux utilisateurs authentifiés qui ont
|    le rôle "admin". (Tu peux mettre 'can:admin' si tu utilises un Gate.)
| 2) Les permissions fines (view/create/update/delete) sont appliquées
|    action par action sur la resource.
|
| IMPORTANT :
| - On NE redéfinit PAS chaque route (index/create/store/...) une seconde fois.
|   Sinon on crée des collisions et des erreurs 405.
*/
Route::middleware(['auth', 'role:admin|planetManager'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('planets', App\Http\Controllers\Admin\PlanetController::class);
    });


// Redirection automatique vers la première planète

Route::get('/destination', function () {
    $first = Planet::first();
    if (!$first) {
        abort(404);
    }

    return redirect()->route('destination.show', $first->slug);
})->name('destination');

//
// 2 - Page Destination avec slug obligatoire
//
Route::get('/destination/{slug}', [DestinationController::class, 'show'])
    ->name('destination.show');
/*
|--------------------------------------------------------------------------
| Routes d’authentification (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
