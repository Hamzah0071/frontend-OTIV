<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\SearchController;

// ==========================================================
// PAGE D'ACCUEIL "/"
// ==========================================================
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect('/login.php');
    }

    return auth()->user()->role === 'admin'
        ? redirect('/admin/admin-dashboard.php')
        : redirect('/client/accueil.php');
});

// ==========================================================
// LOGIN — reste physiquement dans public/, exécuté via require()
// ==========================================================
Route::get('/login.php', function () {
    if (auth()->check()) {
        return redirect(auth()->user()->role === 'admin'
            ? '/admin/admin-dashboard.php'
            : '/client/accueil.php');
    }

    ob_start();
    require public_path('login.php');
    return response(ob_get_clean());
});

// ==========================================================
// TOUTES les pages ADMIN (*.php dans public/admin/)
// Aucun fichier déplacé — on vérifie juste l'accès avant de l'exécuter
// ==========================================================
Route::get('/admin/{file}', function (string $file) {
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect('/login.php');
    }

    $path = public_path("admin/{$file}");

    if (!file_exists($path)) {
        abort(404);
    }

    ob_start();
    require $path;
    return response(ob_get_clean());
})->where('file', '.*\.php$');

// ==========================================================
// TOUTES les pages CLIENT (*.php dans public/client/)
// ==========================================================
Route::get('/client/{file}', function (string $file) {
    if (!auth()->check()) {
        return redirect('/login.php');
    }

    $path = public_path("client/{$file}");

    if (!file_exists($path)) {
        abort(404);
    }

    ob_start();
    require $path;
    return response(ob_get_clean());
})->where('file', '.*\.php$');

// ==========================================================
// API — Explorateur de fichiers
// ==========================================================
Route::get('/api/explorer', [ExplorerController::class, 'index']);
Route::post('/api/dossiers', [ExplorerController::class, 'createFolder'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);
Route::get('/api/fichiers/{id}/preview', [ExplorerController::class, 'getPreviewConfig']);
Route::get('/api/fichiers/{id}/open', [ExplorerController::class, 'openUniversalFile']);
Route::post('/api/fichiers', [ExplorerController::class, 'uploadFile'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);

Route::get('/api/recherche', [SearchController::class, 'search']);

Route::get('/api/fichiers/{id}/stream', [ExplorerController::class, 'streamFile']);
Route::post('/api/onlyoffice/callback', [ExplorerController::class, 'onlyOfficeCallback'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);

Route::post('/api/fichiers/creer-office', [ExplorerController::class, 'createOfficeDocument'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);
Route::get('/api/fichiers/{id}/historique', [ExplorerController::class, 'getFileHistory']);

Route::post('/api/corbeille/{type}/{id}', [ExplorerController::class, 'moveToTrash'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);

// ==========================================================
// API — Authentification
// ==========================================================
Route::post('/api/login', [AuthController::class, 'login'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);
Route::post('/api/logout', [AuthController::class, 'logout'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);