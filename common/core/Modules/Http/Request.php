<?php
/**
 * Класс управления данными http запроса
 */

declare(strict_types=1);

namespace Core\Modules\Http;

class Request
{
    public const GET = 'GET';
    public const POST = 'POST';

    private static string $url;
    private static string $method;
    private static array $data;

    public function url(): string
    {
        return self::$url ?? '';
    }

    public function uri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function method(): string
    {
        return self::$method ?? '';
    }

    public function data(): array
    {
        return self::$data ?? [];
    }

    public function get(): array
    {
        return self::$data[self::GET] ?? [];
    }

    public function post(): ?array
    {
        return self::$data[self::POST] ?? [];
    }

    public static function init(): void
    {
        self::$method = $_SERVER['REQUEST_METHOD'];
        self::$data[self::GET] = $_GET;
        self::$data[self::POST] = $_POST;
        self::initUrl();
    }

    /**
     * Добавляет параметры в Request
     * @param array $params
     * @param string $type
     * @return bool
     */
    public static function setParams(array $params, string $type = self::GET): bool
    {
        if (!empty($params) && in_array($type, [self::GET, self::POST])) {
            self::$data[$type] = array_merge(self::$data[$type], $params);
            return true;
        }
        return false;
    }

    private static function initUrl(): void
    {
        $url = explode('?', $_SERVER['REQUEST_URI'])[0];

        if (str_ends_with($url, '/')) {
            $url = substr($url,0,-1);
        }
        self::$url = $url;
    }
}
