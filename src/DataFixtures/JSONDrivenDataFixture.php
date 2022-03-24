<?php

namespace App\DataFixtures;

use App\DataFixtures\Exception\CouldntOpenFileException;
use DirectoryIterator;
use Doctrine\Bundle\FixturesBundle\Fixture;

abstract class JSONDrivenDataFixture extends Fixture
{
    protected const DATA_DIR = __DIR__ . '/files';

    protected function readAllFixtureFilesForType(string $type): array
    {
        $results = [];
        $dir = new DirectoryIterator(self::DATA_DIR . '/' . $type);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isFile()) {
                $results[] = $this->readFixtureFile($type, $fileinfo->getFilename());
            }
        }

        return $results;
    }

    protected function readFixtureFile(string $type, string $name): array
    {
        $path = self::DATA_DIR . '/' . $type . '/' . $name;
        $contents = file_get_contents($path);
        if (! $contents) {
            throw new CouldntOpenFileException("Failed to open file {$path}");
        }
        $res = json_decode($contents, true);
        if (! $res) {
            throw new CouldntOpenFileException("Failed to parse file {$path}");
        }

        return $res;
    }
}
