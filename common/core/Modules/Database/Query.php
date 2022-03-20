<?php

declare(strict_types=1);

namespace Core\Modules\Database;

use Core\Modules\Database\Builders\SelectQueryBuilder;

class Query
{
    public function select(array|string $fields): SelectQueryBuilder
    {
        return (new SelectQueryBuilder())->select($fields);
    }
}