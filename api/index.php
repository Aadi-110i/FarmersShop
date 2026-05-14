<?php

// Show PHP-level errors (before Laravel boots)
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Bootstrap storage directories in /tmp for Vercel's read-only filesystem
$tmpDirs = [
    '/tmp/storage',
    '/tmp/storage/framework',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
}

try {
    // Forward all requests to Laravel's public/index.php
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    // Catch any fatal errors and display them
    http_response_code(500);
    echo "<h1>Laravel Boot Error</h1>";
    echo "<pre>";
    echo "Error: " . $e->getMessage() . "\n\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo "Trace:\n" . $e->getTraceAsString();
    echo "</pre>";
}
