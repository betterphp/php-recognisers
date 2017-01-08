<?php

declare(strict_types=1);

use betterphp\recogniser\file\writable_file_recogniser;

/**
 * @covers \betterphp\recogniser\file\writable_file_recogniser
 */
class WritableFileRecogniserTest extends RecogniserTest {

    public function __construct() {
        parent::__construct(writable_file_recogniser::class);
    }

    public function testRecognises() {
        $this->assertTrue($this->recogniser->recognises(__FILE__));
        $this->assertFalse($this->recogniser->recognises('/some/random/file.missing'));
        $this->assertFalse($this->recogniser->recognises('/etc/shadow'));
    }

}
