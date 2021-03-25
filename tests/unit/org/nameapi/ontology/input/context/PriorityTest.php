<?php

namespace Tests\Unit\Org\NameApi\Ontology\Input\Context;

use Org\NameApi\Ontology\Input\Context\Priority;
use PHPUnit\Framework\TestCase;

class PriorityTest extends TestCase
{

    public function testEquality()
    {
        $this->assertEquals(Priority::REALTIME(), Priority::REALTIME());
        $this->assertTrue(Priority::REALTIME() === Priority::REALTIME());
        $this->assertEquals('REALTIME', (string)Priority::REALTIME());
    }

}

