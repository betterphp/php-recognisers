<?php

declare(strict_types=1);

namespace betterphp\recogniser\file;

class image_recogniser extends file_recogniser {

    /**
     * @inheritDoc
     */
    public function recognises(string $input): ?bool {
        $recognised_file = parent::recognises($input);

        if ($recognised_file !== true) {
            return $recognised_file;
        }

        // If mime type indicates a type of image then it's an image
        $info = new \finfo(FILEINFO_MIME);
        $mime = $info->file($input);
        $parts = explode('/', $mime);

        if ($parts[0] === 'image') {
            return true;
        }

        // If it's something we can load via GD then it's an image
        $image = @imagecreatefromstring(file_get_contents($input));

        if ($image !== false) {
            return true;
        }

        return false;
    }

}
