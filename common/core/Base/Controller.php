<?php
/**
 * Базовый класс контроллера
 */

declare(strict_types=1);

namespace Core\Base;

use Core\Modules\Data\Container;
use Core\Modules\Http\Request;
use Core\Modules\Http\Response;

class Controller
{
    public Request $request;
    public Response $response;
    public Container $container;

    public function __construct(Container $container)
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->container = $container;
    }
}
