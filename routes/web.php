<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\AnimalController;
use App\Http\Controllers\Web\AdoptionController;
use App\Http\Controllers\Web\ReportController;
use App\Http\Controllers\Web\ContentController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/animais', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animais/{animal}', [AnimalController::class, 'show'])->name('animals.show');
Route::get('/adocoes/criar/{animal}', [AdoptionController::class, 'create'])->name('adoptions.create');
Route::post('/adocoes', [AdoptionController::class, 'store'])->name('adoptions.store');
Route::get('/denuncias/criar', [ReportController::class, 'create'])->name('reports.create');

Route::get('/denuncias/criar', [ReportController::class, 'create'])->name('reports.create');
Route::post('/denuncias', [ReportController::class, 'store'])->name('reports.web.store');
Route::get('/conteudos', [ContentController::class, 'index'])->name('contents.index');
Route::get('/conteudos/{content:slug}', [ContentController::class, 'show'])->name('contents.show');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('admin')->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/categorias', [DashboardController::class, 'categorias'])->name('categorias');
        Route::get('/categorias/criar', [DashboardController::class, 'categoriasCreate'])->name('categorias.create');
        Route::get('/categorias/{id}/editar', [DashboardController::class, 'categoriasEdit'])->name('categorias.edit');

        Route::get('/animais', [DashboardController::class, 'animais'])->name('animais');
        Route::get('/animais/criar', [DashboardController::class, 'animaisCreate'])->name('animais.create');
        Route::get('/animais/{id}/editar', [DashboardController::class, 'animaisEdit'])->name('animais.edit');
        
        Route::get('/conteudos', [DashboardController::class, 'conteudos'])->name('conteudos');
        Route::get('/conteudos/criar', [DashboardController::class, 'conteudosCreate'])->name('conteudos.create');
        Route::get('/conteudos/{id}/editar', [DashboardController::class, 'conteudosEdit'])->name('conteudos.edit');
        Route::get('/denuncias', [DashboardController::class, 'denuncias'])->name('denuncias');
        Route::get('/adocoes', [DashboardController::class, 'adocoes'])->name('adocoes');
        Route::get('/usuarios', [DashboardController::class, 'usuarios'])->name('usuarios');
        Route::get('/usuarios/criar', [DashboardController::class, 'usuariosCreate'])->name('usuarios.create');
        Route::get('/usuarios/{id}/editar', [DashboardController::class, 'usuariosEdit'])->name('usuarios.edit');
        Route::get('/organizacoes', [DashboardController::class, 'organizacoes'])->name('organizacoes');
        Route::get('/organizacoes/criar', [DashboardController::class, 'organizacoesCreate'])->name('organizacoes.create');
        Route::get('/organizacoes/{id}/editar', [DashboardController::class, 'organizacoesEdit'])->name('organizacoes.edit');
    });
});