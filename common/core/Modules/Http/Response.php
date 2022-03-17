<?php

declare(strict_types=1);

namespace Core\Modules\Http;

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
    private array $params = [];

    public function code(int $responseCode): self
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    public function params(array $params): self
    {
        $this->params = $params;
        return $this;
    }

    public function json(array $data): void
    {
        http_response_code($this->responseCode);
        header('Content-Type: application/json');
        print_r(json_encode($data));
        die();
    }

    /**
     * @throws ResponseException
     */
    public function render(string $file): void
    {
        http_response_code($this->responseCode);
        $loader = new Twig_Loader_Filesystem(ROOT . '/resources');

        $twig = new Twig_Environment(
            $loader,
            ['cache' => ROOT . '/tmp/cache/twig',]
        );

        try {
            echo $twig->render($file, $this->params);
        } catch (Error $e) {
            ResponseException::twigError($e);
        }

        die();
    }

    /**
     * @throws ResponseException
     */
    public function notFound(array $fields = null, bool $isApi = false): void
    {
        $this->code(Response::NOT_FOUND);

        if (!$isApi) {
            if (!empty($message)) {
                $this->params['message'] = $message;
            }
            $this->render("/pages/404.html");
        } else {
            if (!empty($message)) {
                $this->json($fields);
            }
            $this->json(['message' => 'Not found']);
        }
    }
}
