<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransfertController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\ContactController;

/**
 * Routes de l'application bancaire Laravel
 * Définit toutes les routes accessibles dans l'application
 */

// Route racine - Redirige vers dashboard si connecté, sinon page d'accueil
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
});

// Route du tableau de bord - Accessible uniquement aux utilisateurs authentifiés
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    // Routes de gestion du profil utilisateur (fournies par Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes de gestion des comptes bancaires
    Route::resource('comptes', CompteController::class); // CRUD complet des comptes
    Route::post('comptes/{id}/deposer', [CompteController::class, 'deposer'])->name('comptes.deposer'); // Dépôt d'argent

    // Routes de gestion des contacts
    Route::resource('contacts', ContactController::class); // CRUD complet des contacts

    // Routes de gestion des transferts (uniquement certaines actions)
    Route::resource('transferts', TransfertController::class)->only(['index', 'create', 'store', 'destroy']);
});

// Inclusion des routes d'authentification (login, register, etc.) fournies par Breeze
require __DIR__.'/auth.php';
