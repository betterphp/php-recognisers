<?php

declare(strict_types=1);

use betterphp\recogniser\file\file_recogniser;

/**
 * @covers \betterphp\recogniser\file\file_recogniser
 */
class FileRecogniserTest extends RecogniserTest {

    public function __construct() {
        parent::__construct(file_recogniser::class);
    }

    public function testRecognises() {
        $this->assertTrue($this->recogniser->recognises(__FILE__));
        $this->assertFalse($this->recogniser->recognises('/some/random/file.missing'));
    }

}
