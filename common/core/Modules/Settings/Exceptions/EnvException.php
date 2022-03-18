<?php

declare(strict_types=1);

namespace Core\Modules\Settings\Exceptions;

use Core\Base\Exceptions\CoreException;

class EnvException extends CoreException
{
    /**
     * @throws EnvException
     */
    public static function envFilesNotFound()
    {
        throw new self('Environment files: ".env" or ".env.example" not found in root of project');
    }
}
