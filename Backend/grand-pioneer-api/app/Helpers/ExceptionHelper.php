<?php

namespace App\Helpers;

/**
 * Class ExceptionHelper
 * @package App\Helpers
 */
class ExceptionHelper
{
    /**
     * @param \Throwable $throwable
     * @return string
     */
    public static function parseString($throwable)
    {
        return 'Exception: ' . $throwable->getMessage() . ' in ' . $throwable->getFile() . ':' . $throwable->getLine();
    }
}
