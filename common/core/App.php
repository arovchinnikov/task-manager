<?php
/**
 * Главный исполняемый класс приложения
 */

declare(strict_types=1);

namespace Core;

use Core\Modules\Http\Request;
use Core\Modules\Routing\Router;
use Core\Modules\Settings\Config;

class App
{
    /**
     * Запуск приложения
     * @return void
     */
    public static function run(): void
    {
        Config::init();
        Request::init();
        (new Router())
            ->dispatch();
    }
}
