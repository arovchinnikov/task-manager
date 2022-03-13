<?php
/**
 * Содержит правила маршрута
 */

declare(strict_types=1);

namespace Core\Modules\Routing;

class Route
{
    private string $url;
    private string $controller;
    private string $action;

    public function __construct(string $url, string $controller, string $action)
    {
        $this->url = $url;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
