<?php
/**
 * Отвечает за определение и перенаправление по маршрутам
 */

declare(strict_types=1);

namespace Core\Modules\Routing;

use Core\Modules\Http\Exceptions\ResponseException;
use Core\Modules\Http\Request;
use Core\Modules\Http\Response;
use Core\Modules\Routing\Exceptions\RouterException;

class Router
{
    /**
     * @var Route[]
     */
    private static array $routes = [];
    private static Request $request;

    public function __construct()
    {
        self::$request = new Request();
        require_once ROOT.'/config/routes_loader.php';
    }

    public static function add(string $url, string $method, string $controller, string $action): void
    {
        if (self::$request->method() === $method) {
            if (!empty(self::$routes[$url])) {
                RouterException::RouteUrlAlreadyExists();
            }
            self::$routes[] = new Route($url, $controller, $action);
        }
    }

    /**
     * @throws RouterException
     * @throws ResponseException
     */
    public function dispatch(): void
    {
        $route = $this->match();

        if (empty($route)) {
            $this->notFound();
        }

        $this->load($route);
    }

    private function match(): ?Route
    {
        foreach (self::$routes as $route) {
            if (preg_match($this->getRoutePattern($route), self::$request->url(), $rawParams)) {
                $params = [];
                foreach ($rawParams as $name => $value) {
                    if (is_string($name)) {
                        $params[$name] = $value;
                    }
                }
                Request::setParams($params);
                return $route;
            }
        }
        return null;
    }

    private function getRoutePattern(Route $route): string
    {
        $url = $route->url;
        $url = explode('/', $url);
        $pattern = [];

        foreach ($url as $urlPart) {
            // Совпадение с [var]
            if (preg_match("/^\[[-a-z-0-9-_]+\]$/", $urlPart)) {
                $urlPart = str_replace(['[', ']'], '', $urlPart);
                $urlPart = "(?P<".$urlPart.">\w+)";
            }
            $pattern[] = $urlPart;
        }

        $pattern = implode('\/', $pattern);
        return '/^'.$pattern.'$/';
    }

    /**
     * @throws RouterException
     */
    private function load(Route $route): void
    {
        if (!method_exists($route->controller, $route->action)) {
            RouterException::ControllerOrActionNotFound($route->controller, $route->action);
        }
        $params = $this->checkActionParams($route);

        $controller = $route->controller;
        $action = $route->action;

        $controller = new $controller();
        $controller->$action(...$params);
    }

    private function checkActionParams(Route $route): array
    {
        $controller = $route->controller;
        $action = $route->action;

        $reflection = new \ReflectionClass($controller);

        $methods = $reflection->getMethods();

        $reflectionMethod = null;

        foreach ($methods as $method) {
            if ($method->getName() == $action) {
                $reflectionMethod = $method;
                break;
            }
        }

        $parameters = $reflectionMethod->getParameters();

        $params = [];

        foreach ($parameters as $parameter) {
            $parameterClass = $parameter->getType()->getName();
            if (!class_exists($parameterClass)) {
                echo 'ss';
            }

            $params[] = new $parameterClass;
        }

        return $params;
    }

    /**
     * @throws ResponseException
     */
    private function notFound(): void
    {
        (new Response())
            ->html(ROOT.'/resources/html/404.html')
            ->code(Response::NOT_FOUND)
            ->send();
    }
}
