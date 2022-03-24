<?php

namespace App\Common\FS;

interface FileSystemInterface
{
    public function saveContentsToFile(string $contents, string $filename): void;
    public function readContentsFromFile(string $filename): ?string;
    public function isFileExists(string $filename): bool;
}
