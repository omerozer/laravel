<?php

use App\Http\Controllers\KisiController;
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

Route::get('/', [KisiController::class, 'index'])->name('home');
Route::post('/kaydet', [KisiController::class, 'store'])->name('kisi.store');
