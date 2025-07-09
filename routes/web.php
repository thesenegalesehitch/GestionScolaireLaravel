<?php

use App\Http\Controllers\EmployeController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\testaController;
use App\Models\Employe;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('maroute');
});

/*Route::get('ajouter', [EmployeController::class, 'ajouter']);
Route::post('traitement', [EmployeController::class, 'traitement']);
Route::post('update', [EmployeController::class, 'update']);
Route::get('update-employe/{id}', [EmployeController::class, 'edit']);
Route::get('liste', [EmployeController::class, 'liste']);
Route::get('ma-route', [TaskController::class, 'maRoute']);


Route::get('ma-route/{id}', [TaskController::class, 'maRouteParam']);*/

Route::get('/etudiants', [EtudiantController::class, 'liste']);
Route::get('/creer', [EtudiantController::class, 'creerEtudiant']);
Route::post('/enregistrer', [EtudiantController::class, 'enregistrerEtudiant']);
Route::get('/editer/{id}', [EtudiantController::class, 'editerEtudiant']);
Route::post('/update', [EtudiantController::class, 'updateEtudiant']);
Route::get('/supprimer/{id}', [EtudiantController::class, 'supprimerEtudiant']);

/*
use App\Http\Controllers\EtudiantController;

Route::get('/etudiants', [EtudiantController::class, 'liste']);
Route::get('/creer', [EtudiantController::class, 'creerEtudiant']);
Route::post('/enregistrer', [EtudiantController::class, 'enregistrerEtudiant']);
Route::get('/editer/{id}', [EtudiantController::class, 'editerEtudiant']);
Route::post('/update', [EtudiantController::class, 'updateEtudiant']);
Route::get('/supprimer/{id}', [EtudiantController::class, 'supprimerEtudiant']);

*/


//Route::resource('testas',testaController::class);

/*Route::resource('tasks', TaskController::class);*/