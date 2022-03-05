<?php

declare(strict_types=1);

namespace Core\Modules\Http\Exceptions;

use Core\Base\Exceptions\CoreException;

class ResponseException extends CoreException
{
    /**
     * @throws ResponseException
     */
    public static function fileNotFound(string $path)
    {
        throw new self('File "'.$path.'" not found.');
    }

    /**
     * @throws ResponseException
     */
    public static function twigError(\Exception $twigException)
    {
        throw new self($twigException->message);
    }
}
