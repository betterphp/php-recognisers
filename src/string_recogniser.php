<?php

declare(strict_types=1);

namespace betterphp\recogniser;

interface string_recogniser extends recogniser {

    /**
     * Checks if this recogniser recognises something
     *
     * @param string $input The input to check
     *
     * @return boolean True, false or null if undecided
     */
    public function recognises(string $input): ?bool;

}
