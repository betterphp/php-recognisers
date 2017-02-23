<?php

declare(strict_types=1);

use betterphp\recogniser\file\image_recogniser;

use betterphp\native_mock\native_mock;

/**
 * @covers \betterphp\recogniser\file\image_recogniser
 */
class ImageRecogniserTest extends RecogniserTest {

    use native_mock;

    public function __construct() {
        parent::__construct(image_recogniser::class);
    }

    public function setUp() {
        parent::setUp();
        $this->nativeMockSetUp();
    }

    public function tearDown() {
        parent::tearDown();
        $this->nativeMockTearDown();
    }

    public function testRecognises() {
        $this->assertTrue($this->recogniser->recognises($this->getTestFilePath('image.png')));
        $this->assertFalse($this->recogniser->recognises(__FILE__));
        $this->assertFalse($this->recogniser->recognises('/unlikely/to/be/a/file.here'));
    }

    public function testRecognisesWithoutMime() {
        $this->redefineFunction('explode', function (string $seperator, string $input): array {
            return ['text', 'plain'];
        });

        $this->assertTrue($this->recogniser->recognises($this->getTestFilePath('image.png')));
    }

}
