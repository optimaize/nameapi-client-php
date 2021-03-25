<?php

namespace Tests\Unit\Org\NameApi\Ontology\Input\Context;

use Org\NameApi\Ontology\Input\Context\Context;
use Org\NameApi\Ontology\Input\Context\Priority;
use PHPUnit\Framework\TestCase;

class ContextBuilderTest extends TestCase
{

    public function testOne()
    {
        $context = Context::builder()->place('DE')->priority(Priority::REALTIME())->build();
        $this->assertEquals('DE', $context->getPlace());
        $this->assertEquals(Priority::REALTIME(), $context->getPriority());
        $this->assertEquals(array(), $context->getProperties());
    }

}
