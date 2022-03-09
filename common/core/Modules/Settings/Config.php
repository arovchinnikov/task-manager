<?php

declare(strict_types=1);

namespace Core\Modules\Settings;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    public static function init(): void
    {
        (new Dotenv())->loadEnv(ROOT.'/.env');
    }

    public static function env(string $key = null): mixed
    {
        if (!empty($key)) {
            return $_ENV[$key];
        }

        return $_ENV;
    }
}