<?php
/**
 * Run artisan commands during deployment. Continues on failure so critical commands still run.
 */
$baseDir = __DIR__;
$artisan = $baseDir . '/src/artisan';

if (!file_exists($artisan)) {
    fwrite(STDERR, "Error: src/artisan not found\n");
    exit(1);
}

$commands = [
    'package:discover --ansi',
    'filament:upgrade --ansi',
    'migrate --force',
    'storage:link',
];

$failed = [];
$srcDir = $baseDir . '/src';
foreach ($commands as $cmd) {
    $fullCmd = "cd " . escapeshellarg($srcDir) . " && php artisan " . $cmd . " 2>&1";
    $output = [];
    $code = 0;
    exec($fullCmd, $output, $code);
    if ($code !== 0) {
        $failed[] = $cmd;
        fwrite(STDERR, "Warning: artisan {$cmd} failed (code {$code})\n");
        fwrite(STDERR, implode("\n", $output) . "\n");
    }
}

// migrate and storage:link are critical - fail if they didn't run
$critical = ['migrate --force', 'storage:link'];
$criticalFailed = array_intersect($failed, $critical);
if (!empty($criticalFailed)) {
    fwrite(STDERR, "Critical commands failed: " . implode(', ', $criticalFailed) . "\n");
    exit(1);
}

exit(0);
