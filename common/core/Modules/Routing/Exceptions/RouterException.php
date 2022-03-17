<?php

declare(strict_types=1);

namespace Core\Modules\Routing\Exceptions;

use Core\Base\Exceptions\BaseException;

class RouterException extends BaseException
{
    /**
     * @throws RouterException
     */
    public static function routeUrlAlreadyExists(): self
    {
        throw new self('Route url already exists');
    }

    /**
     * @throws RouterException
     */
    public static function controllerOrActionNotFound(string $controller, string $action): self
    {
        throw new self('Controller - "' . $controller . '" or Action - "' . $action . '" not found.');
    }
}
