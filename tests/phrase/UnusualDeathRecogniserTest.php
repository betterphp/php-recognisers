<?php

declare(strict_types=1);

use betterphp\recogniser\phrase\unusual_death_recogniser;

/**
 * @covers \betterphp\recogniser\phrase\unusual_death_recogniser
 */
class UnusualDeathRecogniserTest extends RecogniserTest {

    // These tests rely on the content of a WikiPedia article not changing, not ideal...

    public function __construct() {
        parent::__construct(unusual_death_recogniser::class);
    }

    public function testRecognisesReasons() {
        $this->assertTrue($this->recogniser->recognises('fish jumped into mouth'));
        $this->assertFalse($this->recogniser->recognises('mouth jumped into fish'));
    }

    public function testRecognisesReasonsWithSmallWords() {
        $this->assertTrue($this->recogniser->recognises('tip fish in jumped and into up mouth my'));
    }

    public function testRecognisesReasonsWithLongInput() {
        $long_input_no_spaces = str_repeat('bread', 1000);
        $long_input_spaces = str_repeat('bread ', 1000);

        $this->assertFalse($this->recogniser->recognises($long_input_no_spaces));
        $this->assertFalse($this->recogniser->recognises($long_input_spaces));
    }

    public function testRecognisesName() {
        $this->assertTrue($this->recogniser->recognises('Miguel Martinez'));
    }

}
