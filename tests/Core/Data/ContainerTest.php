<?php

declare(strict_types=1);

namespace Tests\Core\Data;

use Core\Modules\Data\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    private Container $object;

    protected function setUp(): void
    {
        $this->object = new Container();
    }

    public function testAll(): void
    {
        $this->object->register('object', new Container());

        $this->assertNotEmpty($this->object->all());
        $this->assertNotEmpty($this->object->get('object'));
    }
}