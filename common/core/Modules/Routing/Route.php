<?php
/**
 * Содержит правила маршрута
 */

declare(strict_types=1);

namespace Core\Modules\Routing;

class Route
{
    public string $url;
    public string $controller;
    public string $action;

    public function __construct(string $url, string $controller, string $action)
    {
        $this->url = $url;
        $this->controller = $controller;
        $this->action = $action;
    }
}
