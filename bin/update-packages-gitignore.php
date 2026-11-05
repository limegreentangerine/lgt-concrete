<?php

/**
 * Updates /public/packages/.gitignore to include any packages with a composer.json
 */

$packagesDir = __DIR__ . '/../public/packages';
$gitignoreFile = $packagesDir . '/.gitignore';

if (!is_dir($packagesDir)) {
    echo "Error: {$packagesDir} does not exist\n";
    exit(1);
}

// Read existing gitignore entries
$gitignoreEntries = [];
if (file_exists($gitignoreFile)) {
    $content = file_get_contents($gitignoreFile);
    $gitignoreEntries = array_filter(
        array_map('trim', explode("\n", $content)),
        fn($line) => !empty($line) && !str_starts_with($line, '#')
    );
}

// Find packages with composer.json
$packagesToAdd = [];
$items = @scandir($packagesDir);

if ($items === false) {
    echo "Error: Unable to read {$packagesDir}\n";
    exit(1);
}

foreach ($items as $item) {
    if ($item === '.' || $item === '..' || $item === '.gitignore') {
        continue;
    }

    $path = $packagesDir . '/' . $item;
    
    if (is_dir($path) && file_exists($path . '/composer.json')) {
        $packagesToAdd[] = $item . '/';
    }
}

// Merge with existing entries (removing duplicates)
$allEntries = array_unique(array_merge($gitignoreEntries, $packagesToAdd));
sort($allEntries);

// Generate new gitignore content
$newContent = "# for packages installed through composer add them to this gitignore\n";
foreach ($allEntries as $entry) {
    $newContent .= $entry . "\n";
}

// Write back to gitignore
if (file_put_contents($gitignoreFile, $newContent) === false) {
    echo "Error: Unable to write to {$gitignoreFile}\n";
    exit(1);
}

echo "Updated {$gitignoreFile}\n";
echo "Packages found: " . count($packagesToAdd) . "\n";

if (!empty($packagesToAdd)) {
    echo "Entries: " . implode(', ', $packagesToAdd) . "\n";
}
