<?php

use Core\Modules\Http\Request;
use Core\Modules\Routing\Router;

Router::add(
    '/api/health-check',
    Request::GET,
    \App\Main\Controllers\StatusController::class,
    'healthCheck'
);
