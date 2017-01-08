<?php

declare(strict_types=1);

namespace betterphp\recogniser\file;

use betterphp\recogniser\string_recogniser;

class file_recogniser implements string_recogniser {

    /**
     * @inheritDoc
     */
    public function recognises(string $input): ?bool {
        return is_string($input) && is_file($input);
    }

}
