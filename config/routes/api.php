<?php
use Core\Modules\Routing\Router;
use Core\Modules\Http\Request;

Router::add(
    '/api/health-check',
    Request::GET,
    \App\Controllers\Api\StatusController::class,
    'healthCheck'
);