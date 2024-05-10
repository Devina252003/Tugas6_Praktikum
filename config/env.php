<?php
function parseEnv($filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("The .env file does not exist.");
    }

    $contents = file_get_contents($filePath);
    $lines = explode("\n", $contents);
    $env = [];

    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $env[trim($key)] = trim($value);
        }
    }

    return $env;
}

$_ENV = parseEnv(".env");
?>
