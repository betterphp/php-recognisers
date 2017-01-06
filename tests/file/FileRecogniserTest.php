<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use betterphp\recogniser\file\file_recogniser;

class FileRecogniserTest extends TestCase {

    private $recogniser;

    public function setUp() {
        $this->recogniser = new file_recogniser();
    }

    public function tearDown() {
        unset($this->recogniser);
    }

    public function testRecognises() {
        $this->assertTrue($this->recogniser->recognises(__FILE__));
        $this->assertFalse($this->recogniser->recognises('/some/random/file.missing'));
    }

}
