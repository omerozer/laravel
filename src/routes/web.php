<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\KisiController;
use App\Http\Controllers\SettingsMediaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

// Filament asset fallback: Hostinger vb. ortamlarda statik dosya 404 olursa Laravel'den sun
$filamentAssetPaths = ['fonts/filament', 'css/filament', 'js/filament'];
foreach ($filamentAssetPaths as $prefix) {
    Route::get("{$prefix}/{path}", function (string $path) use ($prefix): Response {
        $path = str_replace(['../', '..'.DIRECTORY_SEPARATOR], '', $path);
        $fullPath = public_path("{$prefix}/{$path}");
        if (!File::isFile($fullPath) || !str_starts_with(realpath($fullPath), realpath(public_path()))) {
            abort(404);
        }
        $mime = match (pathinfo($fullPath, PATHINFO_EXTENSION)) {
            'css' => 'text/css',
            'js' => 'application/javascript',
            'woff2' => 'font/woff2',
            'woff' => 'font/woff',
            default => File::mimeType($fullPath),
        };
        return response()->file($fullPath, ['Content-Type' => $mime]);
    })->where('path', '.*')->name("filament.assets.{$prefix}");
}

// Vite build assets fallback: document root src/public değilse /build/assets/* 404 olur; Laravel'den sun
Route::get('build/assets/{path}', function (string $path): Response {
    $path = str_replace(['../', '..'.DIRECTORY_SEPARATOR], '', $path);
    $fullPath = public_path("build/assets/{$path}");
    if (!File::isFile($fullPath)) {
        abort(404);
    }
    $base = realpath(public_path('build/assets'));
    if (!$base || !str_starts_with(realpath($fullPath), $base)) {
        abort(404);
    }
    $mime = match (pathinfo($fullPath, PATHINFO_EXTENSION)) {
        'css' => 'text/css',
        'js' => 'application/javascript',
        default => File::mimeType($fullPath),
    };
    return response()->file($fullPath, ['Content-Type' => $mime]);
})->where('path', '.*')->name('vite.build.assets');

Route::get('/', [KisiController::class, 'index'])->name('home');
Route::post('/kaydet', [KisiController::class, 'store'])->name('kisi.store');
Route::put('/kisi/{kisi}', [KisiController::class, 'update'])->name('kisi.update');

Route::view('/component', 'components')->name('components.gallery');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/kategori/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/post/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/{slug}', function (string $slug) {
    return redirect()->route('blog.show', ['slug' => $slug], 301);
})->name('blog.show.redirect');
