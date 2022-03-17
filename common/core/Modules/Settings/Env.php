<?php

/**
 * Класс работы с переменными окружения
 */

declare(strict_types=1);

namespace Core\Modules\Settings;

use Symfony\Component\Dotenv\Dotenv;

class Env
{
    public static function init(): void
    {
        (new Dotenv())->loadEnv(ROOT . '/.env');
    }

    public static function get(string $key = null): mixed
    {
        if (!empty($key)) {
            return $_ENV[$key];
        }

        return $_ENV;
    }
}
