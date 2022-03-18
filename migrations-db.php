<?php

require 'common/const.php';
require 'vendor/autoload.php';

use Core\Modules\Settings\Env;

Env::init(__DIR__);

return [
    'dbname' => Env::get('POSTGRES_DATABASE'),
    'user' => Env::get('POSTGRES_USER'),
    'password' => Env::get('POSTGRES_PASSWORD'),
    'host' => Env::get('POSTGRES_HOST'),
    'driver' => 'pdo_pgsql'
];
