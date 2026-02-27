<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SettingsMediaController extends Controller
{
    /**
     * Serve logo/favicon files from private storage (settings/public, settings/dashboard, settings/favicon).
     */
    public function __invoke(Request $request, string $path): Response
    {
        $path = str_replace(['../', '..\\'], '', $path);

        $allowedPrefixes = ['settings/public/', 'settings/dashboard/', 'settings/favicon/'];
        $allowed = false;
        foreach ($allowedPrefixes as $prefix) {
            if (str_starts_with($path, $prefix)) {
                $allowed = true;
                break;
            }
        }
        if (!$allowed || !Storage::disk('local')->exists($path)) {
            abort(404);
        }

        $mime = Storage::disk('local')->mimeType($path) ?: 'application/octet-stream';
        $contents = Storage::disk('local')->get($path);

        return response($contents, 200, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
