<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\AnimalController;
use App\Http\Controllers\Api\AnimalPhotoController;
use App\Http\Controllers\Api\AdoptionController;
use App\Http\Controllers\Api\AdoptionFollowupController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ReportAttachmentController;
use App\Http\Controllers\Api\AuditLogController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::post('/auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/auth/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

// Public browsing
Route::get('/animals', [AnimalController::class, 'index']);
Route::get('/organizations', [OrganizationController::class, 'index']);
Route::get('/organizations/{organization}', [OrganizationController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/contents', [ContentController::class, 'index']);
Route::get('/contents/{content}', [ContentController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Minhas adoções (adotante)
    Route::get('/my-adoptions', [AdoptionController::class, 'myAdoptions']);

    // Users
    Route::apiResource('users', UserController::class);

    // Organizations
    Route::apiResource('organizations', OrganizationController::class);

    // Organization ↔ Users pivot
    Route::post('/organizations/{organization}/users/{user}', [OrganizationController::class, 'attachUser']);
    Route::delete('/organizations/{organization}/users/{user}', [OrganizationController::class, 'detachUser']);

    // Animals
    Route::get('/animals/{animal}', [AnimalController::class, 'show']);
    Route::apiResource('animals', AnimalController::class)->except(['index', 'show']);

    // Animal Photos
    Route::apiResource('animal-photos', AnimalPhotoController::class);

    // Adoptions
    Route::apiResource('adoptions', AdoptionController::class);

    // Adoption Followups
    Route::apiResource('adoption-followups', AdoptionFollowupController::class);

    // Categories
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);

    // Contents
    Route::apiResource('contents', ContentController::class)->except(['index', 'show']);

    // Reports
    Route::apiResource('reports', ReportController::class);

    // Report Attachments
    Route::apiResource('report-attachments', ReportAttachmentController::class);

    // Audit Logs
    Route::apiResource('audit-logs', AuditLogController::class)->only(['index', 'show']);
});
