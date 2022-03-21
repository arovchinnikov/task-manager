<?php

declare(strict_types=1);

namespace Core\Modules\Data\Interfaces;

interface Arrayable
{
    public function toArray(): array;
}
