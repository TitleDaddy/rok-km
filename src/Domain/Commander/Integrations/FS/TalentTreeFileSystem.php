<?php

namespace App\Domain\Commander\Integrations\FS;

use App\Common\FS\FlySystem\FlySystemStorage;

class TalentTreeFileSystem extends FlySystemStorage implements TalentTreeFileSystemInterface
{
    private const FS_SUBDIR = 'domain/commander/talent_trees';

    private function prefixFilename(string $filename): string
    {
        return sprintf('%s/%s', self::FS_SUBDIR, $filename);
    }

    public function saveContentsToFile(string $contents, string $filename): void
    {
        parent::saveContentsToFile($contents, $this->prefixFilename($filename));
    }

    public function readContentsFromFile(string $filename): ?string
    {
        return parent::readContentsFromFile($this->prefixFilename($filename));
    }

    public function isFileExists(string $filename): bool
    {
        return parent::isFileExists($this->prefixFilename($filename));
    }
}
