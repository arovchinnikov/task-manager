<?php

declare(strict_types=1);

namespace Core\Modules\Http\Exceptions;

use Core\Base\Exceptions\CoreException;

class ResponseException extends CoreException
{
    /**
     * @throws ResponseException
     */
    public static function htmlNotFound(string $path)
    {
        throw new self('Html file "'.$path.'" not found.');
    }
}
