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
// Route pour afficher la liste des employés
Route::get('/employes', [EmployeController::class, 'liste']);
Route::get('/ajouter-employe', [EmployeController::class, 'creerEmploye']);
Route::post('/enregistrer-employe', [EmployeController::class, 'enregistrerEmploye']);
Route::get('/update-employe/{id}', [EmployeController::class, 'editerEmploye']);
Route::post('/update-employe', [EmployeController::class, 'updateEmploye']);
Route::get('/delete-employe/{id}', [EmployeController::class, 'supprimerEmploye']);
// Route pour afficher la liste des voitures 
Route::get('/voitures', [VoitureController::class, 'liste']);
Route::get('/ajouter-voiture', [VoitureController::class, 'creerVoiture']);
Route::post('/enregistrer-voiture', [VoitureController::class, 'enregistrerVoiture']);
Route::get('/update-voiture/{id}', [VoitureController::class, 'editerVoiture']);
Route::post('/update-voiture', [VoitureController::class, 'updateVoiture']);
Route::get('/delete-voiture/{id}', [VoitureController::class, 'supprimerVoiture']);
// Route pour afficher la liste des tâches

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');


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