<?php

use Core\Modules\Http\Request;
use Core\Modules\Routing\Router;

Router::add(
    '/api/health-check',
    Request::GET,
    \App\Api\Controllers\StatusController::class,
    'healthCheck'
);