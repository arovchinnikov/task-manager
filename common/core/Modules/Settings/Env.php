<?php

/**
 * Класс работы с переменными окружения
 */

declare(strict_types=1);

namespace Core\Modules\Settings;

use Core\Modules\Settings\Exceptions\EnvException;
use Symfony\Component\Dotenv\Dotenv;

class Env
{
    /**
     * @throws EnvException
     */
    public static function init(string $envRootPath = ROOT): void
    {
        if (file_exists($envRootPath . '/.env')) {
            (new Dotenv())->loadEnv($envRootPath . '/.env');
        } elseif (file_exists($envRootPath . '/.env.example')) {
            (new Dotenv())->loadEnv($envRootPath . '/.env.example');
        } else {
            EnvException::envFilesNotFound();
        }
    }

    public static function get(string|array $keys = null): mixed
    {
        if (is_array($keys)) {
            $return = [];

            foreach ($keys as $key) {
                $return[] = $_ENV[$key];
            }

            return $return;
        }

        if (!empty($keys)) {
            return $_ENV[$keys];
        }

        return $_ENV;
    }
}
