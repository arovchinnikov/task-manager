<?php
/**
 * Базовый класс контроллера
 */

declare(strict_types=1);

namespace Core\Base;

use Core\Modules\Http\Request;
use Core\Modules\Http\Response;

class Controller
{
    public Request $request;
    public Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }
}
