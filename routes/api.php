<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EducationalContentController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\FeedbackController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/animals', [AnimalController::class, 'index']);
Route::get('/animals/{animal}', [AnimalController::class, 'show']);

Route::get('/contents', [EducationalContentController::class, 'index']);
Route::get('/contents/{slug}', [EducationalContentController::class, 'show']);

Route::post('/reports/public', [ReportController::class, 'storePublic']);

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Autenticação)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Autenticação
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    /*
    |----------------------
    | Organizações
    |----------------------
    */

    Route::middleware('role:admin,protector')->group(function () {
        Route::apiResource('organizations', OrganizationController::class)->except(['index', 'show']);
    });

    Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::get('/organizations/{organization}', [OrganizationController::class, 'show']);

    /*
    |----------------------
    | Animais
    |----------------------
    */

    Route::middleware('role:admin,protector')->group(function () {
        Route::post('/animals', [AnimalController::class, 'store']);
        Route::put('/animals/{animal}', [AnimalController::class, 'update']);
        Route::delete('/animals/{animal}', [AnimalController::class, 'destroy']);

        Route::post('/animals/{animal}/photos', [AnimalController::class, 'uploadPhoto']);
        Route::delete('/animals/{animal}/photos/{photo}', [AnimalController::class, 'deletePhoto']);
    });

    /*
    |----------------------
    | Adoções
    |----------------------
    */

    Route::middleware('role:admin,adopter,protector')->group(function () {
        Route::post('/adoptions', [AdoptionController::class, 'store']);
        Route::get('/adoptions', [AdoptionController::class, 'index']);
        Route::get('/adoptions/{adoption}', [AdoptionController::class, 'show']);
    });

    Route::middleware('role:admin,protector')->group(function () {
        Route::patch('/adoptions/{adoption}/approve', [AdoptionController::class, 'approve']);
        Route::patch('/adoptions/{adoption}/reject', [AdoptionController::class, 'reject']);
        Route::patch('/adoptions/{adoption}/complete', [AdoptionController::class, 'complete']);
    });

    /*
    |----------------------
    | Denúncias
    |----------------------
    */

    Route::middleware('role:admin,protector')->group(function () {
        Route::get('/reports', [ReportController::class, 'index']);
        Route::get('/reports/{report}', [ReportController::class, 'show']);
        Route::patch('/reports/{report}', [ReportController::class, 'update']);
        Route::patch('/reports/{report}/assign', [ReportController::class, 'assign']);
        Route::patch('/reports/{report}/resolve', [ReportController::class, 'resolve']);
        Route::patch('/reports/{report}/dismiss', [ReportController::class, 'dismiss']);
    });

    /*
    |----------------------
    | Conteúdo Educativo
    |----------------------
    */

    Route::middleware('role:admin')->group(function () {
        Route::post('/contents', [EducationalContentController::class, 'store']);
        Route::put('/contents/{content}', [EducationalContentController::class, 'update']);
        Route::delete('/contents/{content}', [EducationalContentController::class, 'destroy']);
        Route::patch('/contents/{content}/publish', [EducationalContentController::class, 'publish']);
        Route::patch('/contents/{content}/unpublish', [EducationalContentController::class, 'unpublish']);
    });

    /*
    |----------------------
    | Feedback
    |----------------------
    */

    Route::middleware('role:admin,adopter,protector')->group(function () {
        Route::post('/feedbacks', [FeedbackController::class, 'store']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/feedbacks', [FeedbackController::class, 'index']);
    });
});
