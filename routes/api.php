<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/affichejoueurs/{idequipe}/{idjeu}' , [App\Http\Controllers\JOUEURSController::class, 'affichejoueurs']);

Route::get('/joueurs', [App\Http\Controllers\JOUEURSController::class, 'list']);

Route::get('/affichedetailsjoueur/{idjoueur}' , [App\Http\Controllers\JOUEURSController::class, 'affichedetailsjoueur']);

Route::get('/equipes', [App\Http\Controllers\EQUIPEController::class, 'list']);

Route::get('/utilisateur', [App\Http\Controllers\UTILISATEURController::class, 'list']);

Route::post('/adduti', [App\Http\Controllers\UTILISATEURController::class, 'ajoututi']);

//// RENCONTRES 

Route::get('/rencontres', [App\Http\Controllers\RENCONTREController::class, 'ListeRencontres']);

Route::post('/rencontres', [App\Http\Controllers\RENCONTREController::class, 'AjouterRencontre']);

Route::put('/rencontres', [App\Http\Controllers\RENCONTREController::class, 'modifierRencontre']);

Route::post('/parier', [App\Http\Controllers\PARIERController::class, 'Ajoutepari']);


// //// TOURNOIS

// Route::get('/listetournois',[App\Http\Controllers\TOURNOISController::class, 'ListeTournois']);

// Route::post('/ajouttournois',[App\Http\Controllers\TOURNOISController::class, 'AjouterTournois']);

// Route::delete('/suprtournois/{idtournois}',[App\Http\Controllers\TOURNOISController::class, 'SupprimerTournois']);

