<?php

declare(strict_types=1);

namespace Core\Modules\Data\Exceptions;

use Core\Base\Exceptions\CoreException;

class ContainerException extends CoreException
{
    /**
     * @throws ContainerException
     */
    public static function keyAlreadyExists(string $key)
    {
        throw new self("Key '$key' already exists in container");
    }

    /**
     * @throws ContainerException
     */
    public static function createObjectError(string $className)
    {
        throw new self("Error to create object: '$className'");
    }

    /**
     * @throws ContainerException
     */
    public static function objectNotFound(string $key)
    {
        throw new self("Key '$key' not found in container");
    }
}
