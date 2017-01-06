<?php

declare(strict_types=1);

use betterphp\recogniser\file\readable_file_recogniser;

/**
 * @covers \betterphp\recogniser\file\readable_file_recogniser
 */
class ReadableFileRecogniserTest extends RecogniserTest {

    public function __construct() {
        parent::__construct(readable_file_recogniser::class);
    }

    public function testRecognises() {
        $this->assertTrue($this->recogniser->recognises(__FILE__));
        $this->assertFalse($this->recogniser->recognises('/some/random/file.missing'));
        $this->assertFalse($this->recogniser->recognises('/etc/shadow'));
    }

}
