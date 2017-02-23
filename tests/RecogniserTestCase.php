<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
abstract class RecogniserTestCase extends TestCase {

    protected function getTestFilePath(string $name): string {
        $file_path = __DIR__ . '/../test-data/' . $name;

        if (!file_exists($file_path)) {
            throw new \Exception('Could not find test data file named ' . $name);
        }

        return $file_path;
    }

}
