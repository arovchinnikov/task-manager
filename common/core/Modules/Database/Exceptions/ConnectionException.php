<?php

declare(strict_types=1);

namespace Core\Modules\Database\Exceptions;

use Core\Base\Exceptions\CoreException;

class ConnectionException extends CoreException
{
    /**
     * @throws ConnectionException
     */
    public static function connectionFailed(\PDOException $e)
    {
        throw new self($e->getMessage());
    }

    /**
     * @throws ConnectionException
     */
    public static function alreadyConnected()
    {
        throw new self('Already connected to database');
    }
}