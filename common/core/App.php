<?php

/**
 * Главный исполняемый класс приложения
 */

declare(strict_types=1);

namespace Core;

use Core\Modules\Http\Request;
use Core\Modules\Routing\Router;
use Core\Modules\Settings\Env;

class App
{
    /**
     * Запуск приложения
     * @return void
     */
    public static function run(): void
    {
        self::init();
        (new Router())
            ->dispatch();
    }

    /**
     * @throws Modules\Settings\Exceptions\EnvException
     */
    private static function init(): void
    {
        //TODO добавить обработку dev окружения
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        require_once ROOT . '/common/functions/debug.php';
        Env::init(ROOT);
        Request::init();
    }
}
