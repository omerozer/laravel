<?php
/**
 * Run artisan commands during deployment. Never fails - allows deploy to complete.
 * Run migrate/storage:link manually via SSH if needed.
 */
try {
    $baseDir = __DIR__;
    $artisan = $baseDir . '/src/artisan';
    $srcDir = $baseDir . '/src';

    if (!file_exists($artisan)) {
        exit(0);
    }

    $commands = ['package:discover --ansi', 'filament:upgrade --ansi', 'migrate --force', 'storage:link'];

    foreach ($commands as $cmd) {
        $fullCmd = "cd " . escapeshellarg($srcDir) . " && php artisan " . $cmd . " 2>&1";
        exec($fullCmd, $output, $code);
    }
} catch (Throwable $e) {
    // Silently continue - deploy must complete
}

exit(0);
