<?php

namespace org\nameapi\client\services\email\emailnameparser;

require_once(__DIR__.'/../../BaseServiceTest.php');

use org\nameapi\client\services\BaseServiceTest;

class EmailNameParserServiceTest extends BaseServiceTest {

    public function testParse_John_Doe() {
        $emailNameParser = $this->makeServiceFactory()->emailServices()->emailNameParser();
        $result = $emailNameParser->parse("john.doe@example.com");
        $this->assertEquals('PERSON_NAME', $result->getResultType()->toString());
        $firstMatch = $result->getMatches()[0];
        $this->assertEquals('john', $firstMatch->getGivenNames()[0]->getName());
        $this->assertEquals('doe', $firstMatch->getSurnames()[0]->getName());
    }

    public function testParse_John_F_Doe() {
        $emailNameParser = $this->makeServiceFactory()->emailServices()->emailNameParser();
        $result = $emailNameParser->parse("john.f.doe@example.com");
        $this->assertEquals('PERSON_NAME', $result->getResultType()->toString());
        $firstMatch = $result->getMatches()[0];
        $this->assertEquals('john', $firstMatch->getGivenNames()[0]->getName());
//        $this->assertEquals('f', $firstMatch->getGivenNames()[1]->getName());
//        $this->assertEquals('INITIAL', $firstMatch->getGivenNames()[1]->getNameType()->toString());
        $this->assertEquals('doe', $firstMatch->getSurnames()[0]->getName());
    }

    public function testParse_webmaster() {
        $emailNameParser = $this->makeServiceFactory()->emailServices()->emailNameParser();
        $result = $emailNameParser->parse("webmaster@example.com");
        $this->assertEquals('TECHNICAL', $result->getResultType()->toString());
    }

}
