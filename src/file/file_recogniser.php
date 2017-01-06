<?php

declare(strict_types=1);

namespace betterphp\recogniser\file;

use betterphp\recogniser\recogniser;

class file_recogniser implements recogniser {

    /**
     * @inheritDoc
     */
    public function recognises($input) {
        return is_string($input) && is_file($input);
    }

}
