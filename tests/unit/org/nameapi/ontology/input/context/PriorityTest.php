<?php

namespace org\nameapi\ontology\input\context;

require_once(__DIR__.'/../../../../../../../src/org/nameapi/ontology/input/context/Priority.php');

class PriorityTest extends \PHPUnit_Framework_TestCase {

    public function testEquality() {
        $this->assertEquals(Priority::REALTIME(), Priority::REALTIME());
        $this->assertTrue(Priority::REALTIME() === Priority::REALTIME());
        $this->assertEquals('REALTIME', (string)Priority::REALTIME());
    }

}

