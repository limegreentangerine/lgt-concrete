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

$default = basename(str_replace(['.local', '.'], ['', '-'], $root));
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

do {
    echo 'SMTP Mail Username: ';
    $smtpUsername = trim((string) fgets(STDIN));
    $isValidUsername = strlen($smtpUsername) > 0;
    if (!$isValidUsername) {
        echo "Enter a SMTP mail username." . PHP_EOL;
    }
} while (!$isValidUsername);

do {
    echo 'SMTP Mail Password: ';
    $smtpPassword = trim((string) fgets(STDIN));
    $isValidPassword = strlen($smtpPassword) > 0;
    if (!$isValidPassword) {
        echo "Enter a SMTP mail password." . PHP_EOL;
    }
} while (!$isValidPassword);

$envFile = $root . '/.env';
$envFileExists = file_exists($envFile);
$envContents = '';
if ($envFileExists) {
    $envContents = file_get_contents($envFile);
    if ($envContents === false) {
        throw new RuntimeException('Failed to read .env file.');
    }
}

$envValues = [
    'MAIL_USERNAME' => $smtpUsername,
    'MAIL_PASSWORD' => $smtpPassword,
];
$formatEnvValue = static fn(string $value): string => "'" . str_replace("'", "'\"'\"'", $value) . "'";
$foundEnvValues = array_fill_keys(array_keys($envValues), false);
$envLines = preg_split('/(\r\n|\n|\r)/', $envContents, -1, PREG_SPLIT_DELIM_CAPTURE);

for ($i = 0; $i < count($envLines); $i += 2) {
    foreach ($envValues as $key => $value) {
        if (preg_match('/^([ \t]*(?:export[ \t]+)?' . $key . '[ \t]*=)/', $envLines[$i], $matches) === 1) {
            $envLines[$i] = $matches[1] . $formatEnvValue($value);
            $foundEnvValues[$key] = true;
        }
    }
}

$envContents = implode('', $envLines);
$lineEnding = str_contains($envContents, "\r\n") ? "\r\n" : "\n";
if ($envContents !== '' && !preg_match('/(?:\r\n|\n|\r)$/', $envContents)) {
    $envContents .= $lineEnding;
}

foreach ($envValues as $key => $value) {
    if (!$foundEnvValues[$key]) {
        $envContents .= $key . '=' . $formatEnvValue($value) . $lineEnding;
    }
}

if (file_put_contents($envFile, $envContents, LOCK_EX) === false) {
    throw new RuntimeException('Failed to write .env file.');
}

if (!$envFileExists && !chmod($envFile, 0600)) {
    throw new RuntimeException('Failed to secure .env file permissions.');
}

echo "\nProject setup complete!\n";

echo "\nTo begin installation run ./vendor/bin/concrete c5:install -i\n";
