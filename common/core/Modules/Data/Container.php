<?php

declare(strict_types=1);

namespace Core\Modules\Data;

use Core\Modules\Data\Exceptions\ContainerException;
use Exception;

class Container
{
    private array $data = [];

    /**
     * @throws ContainerException
     */
    public function register(string $name, string|object $class): object
    {
        if (!empty($this->data[$name])) {
            ContainerException::keyAlreadyExists($name);
        }

        if (!is_object($class)) {
            try {
                $class = new $class();
            } catch (Exception $e) {
                ContainerException::createObjectError($class);
            }
        }
        $this->data[$name] = $class;

        return $class;
    }

    /**
     * @throws ContainerException
     */
    public function get(string $key): object
    {
        if (empty($this->data[$key])) {
            ContainerException::objectNotFound($key);
        }

        return $this->data[$key];
    }

    public function all(): array
    {
        return $this->data;
    }
}
