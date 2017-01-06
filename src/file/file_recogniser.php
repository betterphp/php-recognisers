<?php

declare(strict_types=1);

namespace betterphp\recogniser\file;

class file_recogniser {

    /**
     * @inheritDoc
     */
    public function recognises(string $input) {
        return is_file($input);
    }

}
