<?php

declare(strict_types=1);

namespace betterphp\recogniser\file;

class writable_file_recogniser extends file_recogniser {

    /**
     * @inheritDoc
     */
    public function recognises(string $input): ?bool {
        $recognised_file = parent::recognises($input);

        if ($recognised_file !== true) {
            return $recognised_file;
        }

        return is_writable($input);
    }

}
