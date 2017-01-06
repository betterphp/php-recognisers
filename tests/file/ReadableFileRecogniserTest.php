<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use betterphp\recogniser\file\readable_file_recogniser;

/**
 * @covers \betterphp\recogniser\file\readable_file_recogniser
 */
class ReadableFileRecogniserTest extends TestCase {

    private $recogniser;

    public function setUp() {
        $this->recogniser = new readable_file_recogniser();
    }

    public function tearDown() {
        unset($this->recogniser);
    }

    public function testRecognises() {
        $this->assertTrue($this->recogniser->recognises(__FILE__));
        $this->assertFalse($this->recogniser->recognises('/some/random/file.missing'));
        $this->assertFalse($this->recogniser->recognises('/etc/shadow'));
    }

}
