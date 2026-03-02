<?php
/**
 * Deployment setup: copy .env and generate APP_KEY.
 */
try {
    $baseDir = __DIR__;
    $envPath = $baseDir . '/src/.env';
    $examplePath = $baseDir . '/src/.env.example';

    if (file_exists($examplePath) && !file_exists($envPath)) {
        copy($examplePath, $envPath);
    }

    if (file_exists($envPath)) {
        $env = file_get_contents($envPath);
        if (!preg_match('/^APP_KEY=base64:/m', $env)) {
            $key = 'base64:' . base64_encode(random_bytes(32));
            $env = preg_replace('/^APP_KEY=.*/m', 'APP_KEY=' . $key, $env);
            if (!preg_match('/^APP_KEY=/m', $env)) {
                $env = 'APP_KEY=' . $key . "\n" . $env;
            }
            file_put_contents($envPath, $env);
        }
    }
} catch (Throwable $e) {
    // continue
}
exit(0);
