<?php

declare(strict_types=1);

/**
 * @coversNothing
 */
abstract class RecogniserTest extends RecogniserTestCase {

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
