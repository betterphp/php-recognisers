<?php

declare(strict_types=1);

use betterphp\recogniser\file\image_recogniser;

/**
 * @covers \betterphp\recogniser\file\image_recogniser
 */
class ImageRecogniserTest extends RecogniserTest {

    public function __construct() {
        parent::__construct(image_recogniser::class);
    }

    public function testRecognises() {
        $this->assertTrue($this->recogniser->recognises($this->getTestFilePath('image.png')));
        $this->assertFalse($this->recogniser->recognises(__FILE__));
        $this->assertFalse($this->recogniser->recognises('/unlikely/to/be/a/file.here'));
    }

}
