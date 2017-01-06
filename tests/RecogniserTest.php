<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
abstract class RecogniserTest extends TestCase {

    private $class_name;
    protected $recogniser;

    public function __construct(string $class_name) {
        parent::__construct();

        $this->class_name = $class_name;
    }

    public function setUp() {
        $this->recogniser = new $this->class_name();
    }

    public function tearDown() {
        unset($this->recogniser);
    }

}
