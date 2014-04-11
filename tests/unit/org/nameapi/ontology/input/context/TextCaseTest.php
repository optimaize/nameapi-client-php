<?php

namespace org\nameapi\ontology\input\context;

require_once(__DIR__.'/../../../../../../../src/org/nameapi/ontology/input/context/TextCase.php');

class TextCaseTest extends \PHPUnit_Framework_TestCase {

    public function testEquality() {
        $this->assertEquals(TextCase::TITLE_CASE(), TextCase::TITLE_CASE());
        $this->assertTrue(TextCase::TITLE_CASE() === TextCase::TITLE_CASE());
        $this->assertEquals('TITLE_CASE', (string)TextCase::TITLE_CASE());
    }

}

