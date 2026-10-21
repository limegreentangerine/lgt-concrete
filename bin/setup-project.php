<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$composerFile = $root . '/composer.json';

$composer = json_decode(
    file_get_contents($composerFile),
    true,
    512,
    JSON_THROW_ON_ERROR
);

$default = basename(str_replace('.', '-', $root));
$vendor = 'limegreentangerine';

echo "\nLGT Concrete CMS Project Setup\n\n";

do {
    echo "Project name [{$vendor}/{$default}]: ";

    $line = fgets(STDIN);
    $input = $line === false ? '' : trim($line);

    $name = $input !== ''
        ? $input
        : "{$vendor}/{$default}";

    $valid = preg_match(
        '/^[a-z0-9_.-]+\/[a-z0-9_.-]+$/',
        $name
    ) === 1;

    if (!$valid) {
        if ($line === false) {
            throw new RuntimeException('Invalid default project name.');
        }

        echo "Invalid package name. Use vendor/project.\n";
    }
} while (!$valid);

$composer['name'] = $name;

unset($composer['scripts']['post-create-project-cmd']);

$json = json_encode(
    $composer,
    JSON_PRETTY_PRINT
    | JSON_UNESCAPED_SLASHES
    | JSON_THROW_ON_ERROR
) . PHP_EOL;

if (file_put_contents($composerFile, $json) === false) {
    throw new RuntimeException('Failed to update composer.json.');
}

echo "\nProject configured as {$name}\n";
echo "\nValidating Composer configuration...\n";

if (!chdir($root)) {
    throw new RuntimeException('Failed to change project directory.');
}

$filesDir = '/public/application/files';
if (!is_dir($root . $filesDir) && !mkdir($root . $filesDir, 0755)) {
    throw new RuntimeException("Couldn't create {$filesDir} folder");
}

echo "\nProject setup complete!\n";
