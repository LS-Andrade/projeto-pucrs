<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\AnimalController;
use App\Http\Controllers\Web\AdoptionController;
use App\Http\Controllers\Web\ReportController;
use App\Http\Controllers\Web\ContentController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/animais', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animais/{animal}', [AnimalController::class, 'show'])->name('animals.show');
Route::get('/adocoes/criar/{animal}', [AdoptionController::class, 'create'])->name('adoptions.create');
Route::post('/adocoes', [AdoptionController::class, 'store'])->name('adoptions.store');
Route::get('/denuncias/criar', [ReportController::class, 'create'])->name('reports.create');

Route::get('/denuncias/criar', [ReportController::class, 'create'])->name('reports.create');
Route::post('/denuncias', [ReportController::class, 'store'])->name('reports.store');
Route::get('/conteudos', [ContentController::class, 'index'])->name('contents.index');
Route::get('/conteudos/{content:slug}', [ContentController::class, 'show'])->name('contents.show');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');