<?php

namespace App\Common\FS\FlySystem;

use App\Common\FS\FileSystemInterface;
use League\Flysystem\FilesystemOperator;

class FlySystemStorage implements FileSystemInterface
{
    private FilesystemOperator $filesystemOperator;

    public function __construct(FilesystemOperator $defaultStorage)
    {
        $this->filesystemOperator = $defaultStorage;
    }

    public function saveContentsToFile(string $contents, string $filename): void
    {
        $this->filesystemOperator->write($filename, $contents);
    }

    public function readContentsFromFile(string $filename): ?string
    {
        if ($this->filesystemOperator->has($filename)) {
            return $this->filesystemOperator->read($filename);
        }

        return null;
    }

    public function isFileExists(string $filename): bool
    {
        return $this->filesystemOperator->has($filename);
    }
}
