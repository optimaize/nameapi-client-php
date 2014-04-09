<?php

namespace org\nameapi\ontology\input\entities\person\age;

require_once(__DIR__.'/../../../../../../../../../src/org/nameapi/ontology/input/entities/person/age/AgeInfoFactory.php');

class AgeInfoFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testDate() {
        $ageInfo = AgeInfoFactory::forDate(1917, 5, 29);
        $this->assertEquals($ageInfo->getBirthDay(), 29);
        $this->assertEquals($ageInfo->getBirthMonth(), 5);
        $this->assertEquals($ageInfo->getBirthYear(), 1917);
    }

}
