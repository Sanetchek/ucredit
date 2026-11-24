<?php
/**
 * Setup WP-CLI locally for the theme
 * Downloads wp-cli.phar if it doesn't exist
 */

$wpCliPhar = __DIR__ . '/../wp-cli.phar';
$wpCliUrl = 'https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar';

if (file_exists($wpCliPhar)) {
    echo "WP-CLI already exists.\n";
    exit(0);
}

echo "Downloading WP-CLI...\n";

// Use file_get_contents with context for better error handling
$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => [
            'User-Agent: PHP',
        ],
        'timeout' => 30,
    ],
]);

$content = @file_get_contents($wpCliUrl, false, $context);

if ($content === false) {
    echo "Error: Failed to download WP-CLI.\n";
    echo "Please download it manually from: https://wp-cli.org/\n";
    echo "Or install it globally: https://wp-cli.org/#installing\n";
    exit(1);
}

if (file_put_contents($wpCliPhar, $content) === false) {
    echo "Error: Failed to save WP-CLI.\n";
    exit(1);
}

// Make it executable on Unix systems
if (PHP_OS_FAMILY !== 'Windows') {
    chmod($wpCliPhar, 0755);
}

echo "WP-CLI downloaded successfully!\n";
exit(0);


