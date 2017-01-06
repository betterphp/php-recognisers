<?php

declare(strict_types=1);

namespace betterphp\recogniser;

interface recogniser {

    /**
     * Checks if this recogniser recognises something
     *
     * @param mixed $input The input to check
     *
     * @return boolean True, false or null if undecided
     */
    public function recognises($input);

}
