<?php

use Illuminate\Support\Facades\Route;
use App\Models\Matrice;
use App\Models\TypeAlerte;
use App\Http\Controllers\AlerteController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActionController;

Route::get('/', function () {
    $matrices = Matrice::all();
    $types = TypeAlerte::all();

    return view('dashboard', compact('matrices', 'types'));
})->name('dashboard');

Route::prefix('alerte')->name('alertes.')->group(function () {
    Route::get('create', [AlerteController::class, 'create'])->name('create');
    Route::post('store', [AlerteController::class, 'store'])->name('store');
    Route::get('follow', [AlerteController::class, 'follow'])->name('follow');
    Route::post('show', [AlerteController::class, 'show'])->name('show');
});

// *** Admin *** //

// Connexion / Déconnexion Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

// Dashboard Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

// Gestion des alertes
Route::get('/admin/alertes', [AdminController::class, 'index'])
    ->name('admin.alertes.index');
Route::get('/admin/alertes/{id}', [AdminController::class, 'show'])
    ->name('admin.alertes.show');
Route::put('/admin/alertes/{id}/statut', [AdminController::class, 'updateStatut'])
    ->name('admin.alertes.updateStatut');

// Gestion des actions
Route::post('/admin/alertes/{id}/actions', [ActionController::class, 'store'])
    ->name('admin.actions.store');
Route::get('/admin/alertes/{id}/actions/create', [ActionController::class, 'create'])
    ->name('admin.actions.create');
