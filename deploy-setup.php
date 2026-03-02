<?php
/**
 * Deployment setup: copy .env, generate APP_KEY, run migrations.
 * Run from project root: php deploy-setup.php
 */
$baseDir = __DIR__;
$envPath = $baseDir . '/src/.env';
$examplePath = $baseDir . '/src/.env.example';

if (!file_exists($examplePath)) {
    fwrite(STDERR, "Error: src/.env.example not found\n");
    exit(1);
}

if (!file_exists($envPath)) {
    if (!copy($examplePath, $envPath)) {
        fwrite(STDERR, "Error: Could not copy .env.example to .env\n");
        exit(1);
    }
}

$key = 'base64:' . base64_encode(random_bytes(32));
$env = file_get_contents($envPath);
$env = preg_replace('/^APP_KEY=.*/m', 'APP_KEY=' . $key, $env);
if (!file_put_contents($envPath, $env)) {
    fwrite(STDERR, "Error: Could not write to src/.env\n");
    exit(1);
}

// Run migrations
$artisan = $baseDir . '/src/artisan';
if (file_exists($artisan)) {
    $cmd = 'cd ' . escapeshellarg($baseDir . '/src') . ' && php artisan migrate --force 2>&1';
    exec($cmd, $out, $code);
}

exit(0);
