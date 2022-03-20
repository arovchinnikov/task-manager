<?php

namespace Core\Modules\Database\Interfaces;

interface QueryBuilderInterface
{
    public function getQuery(): string;
}