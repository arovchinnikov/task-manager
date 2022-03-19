<?php

declare(strict_types=1);

namespace Core\Modules\Http;

use Core\Modules\Data\Interfaces\Arrayable;
use Core\Modules\Http\Exceptions\ResponseException;
use Twig\Error\Error;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Response
{
    /* 2XX error codes */
    public const OK = 200;

    /* 4XX error codes */
    public const NOT_FOUND = 404;

    private int $responseCode = self::OK;
    private array $data = [];

    public function code(int $responseCode): self
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    public function add(array|Arrayable $data): self
    {
        $this->data = array_merge($this->data, $this->prepareData($data));

        return $this;
    }

    public function send(array|Arrayable $data = null): void
    {
        http_response_code($this->responseCode);
        header("Content-Type: application/json");

        if (empty($data)) {
            $response = $this->data;
        } else {
            $response = array_merge($this->data, $this->prepareData($data));
        }

        print_r(json_encode($response));
        exit();
    }

    public function notFound(string $route = null): void
    {
        $this
            ->code(Response::NOT_FOUND)
            ->send(["message" => "route not found"]);
    }

    private function prepareData(array|Arrayable $data): array
    {
        if (is_object($data) && is_subclass_of($data, Arrayable::class)) {
            return $data->toArray();
        }

        return $data;
    }
}
