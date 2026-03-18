<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\FavoriController;
use Illuminate\Support\Facades\Route;

// ── Public ────────────────────────────────────────────────
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/offres',          [OffreController::class, 'index']);
Route::get('/offres/{offre}',  [OffreController::class, 'show']);

// ── Protégé (Sanctum) ─────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me',      [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Offres (admin)
    Route::post('/offres',          [OffreController::class, 'store']);
    Route::put('/offres/{offre}',   [OffreController::class, 'update']);
    Route::delete('/offres/{offre}',[OffreController::class, 'destroy']);

    // Candidatures
    Route::post('/offres/{offre}/postuler',  [CandidatureController::class, 'postuler']);
    Route::get('/mes-candidatures',          [CandidatureController::class, 'mesCandidatures']);
    Route::patch('/candidatures/{candidature}/statut', [CandidatureController::class, 'changerStatut']);

    // Favoris
    Route::get('/favoris',               [FavoriController::class, 'index']);
    Route::post('/favoris/{offre}/toggle',[FavoriController::class, 'toggle']);
});
