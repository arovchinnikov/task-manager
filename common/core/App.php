<?php
/**
 * Главный исполняемый класс приложения
 */

declare(strict_types=1);

namespace Core;

use Core\Modules\Http\Request;

class App
{
    /**
     * Запуск приложения
     * @return void
     */
    public static function run(): void
    {
        Request::init();
    }
}