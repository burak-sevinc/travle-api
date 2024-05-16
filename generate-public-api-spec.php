<?php

declare(strict_types=1);

$symlinkTarget = __DIR__ . '/docs';
$symlinkName   = __DIR__ . '/public/docs';

if (file_exists($symlinkName)) {
    echo "The symlink already exists. Nothing to do.\n";
} else {
    if (symlink($symlinkTarget, $symlinkName)) {
        echo "The symlink was created successfully.\n";
    } else {
        echo "Failed to create the symlink.\n";
    }
}
