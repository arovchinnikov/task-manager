<?php

declare(strict_types=1);

namespace Core\Modules\Http;

use Core\Modules\Http\Exceptions\ResponseException;

class Response
{
    /* 2XX error codes */
    public const OK = 200;

    /* 4XX error codes */
    public const NOT_FOUND = 404;

    private array|string $data = '';
    private int $responseCode = self::OK;

    public function data(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function json(array $data = null): self
    {
        header('Content-Type: application/json');
        $this->data = json_encode($data ?? $this->data);

        return $this;
    }

    /**
     * @throws ResponseException
     */
    public function html(string $path): self
    {
        if (!file_exists($path)) {
            ResponseException::htmlNotFound($path);
        }
        $this->data = file_get_contents($path);

        return $this;
    }

    public function code(int $responseCode): self
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    public function send(): void
    {
        http_response_code($this->responseCode);
        print_r($this->data);
        die();
    }
}
