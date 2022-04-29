<?php

namespace Tests\Unit\Org\NameApi\Ontology\Input\Context;

use Org\NameApi\Ontology\Input\Context\TextCase;
use PHPUnit\Framework\TestCase;

class TextCaseTest extends TestCase
{

    public function testEquality()
    {
        $this->assertEquals(TextCase::TITLE_CASE(), TextCase::TITLE_CASE());
        $this->assertTrue(TextCase::TITLE_CASE() === TextCase::TITLE_CASE());
        $this->assertEquals('TITLE_CASE', (string)TextCase::TITLE_CASE());
    }

}

