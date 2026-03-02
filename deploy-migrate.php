<?php
/**
 * Run migrations. Tries multiple methods for restricted hosting.
 */
$srcDir = __DIR__ . '/src';
$artisan = $srcDir . '/artisan';

if (!file_exists($artisan)) {
    exit(0);
}

// Method 1: passthru (often allowed)
if (function_exists('passthru')) {
    chdir($srcDir);
    @passthru('php artisan migrate --force 2>/dev/null', $r);
    exit(0);
}

// Method 2: exec
if (function_exists('exec')) {
    chdir($srcDir);
    @exec('php artisan migrate --force 2>&1', $out, $r);
    exit(0);
}

exit(0);
