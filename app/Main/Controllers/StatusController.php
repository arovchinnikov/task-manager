<?php

declare(strict_types=1);

namespace App\Main\Controllers;

use Core\Base\Controller;
use Core\Modules\Http\Response;

class StatusController extends Controller
{
    public function healthCheck(): void
    {
        $this->response
            ->code(Response::OK)
            ->send(["success" => true]);
    }
}
