<?php

namespace org\nameapi\client\services\matcher\personmatcher;

require_once(__DIR__.'/../../BaseServiceTest.php');

use org\nameapi\client\services\BaseServiceTest;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\ontology\input\entities\person\name\InputPersonName;
use org\nameapi\ontology\input\entities\person\age\AgeInfoFactory;

class PersonMatcherServiceTest extends BaseServiceTest {

    public function testMatch_matching() {
        $personMatcher = $this->makeServiceFactory()->matcherServices()->personMatcher();
        $inputPerson1 = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John F. Kennedy" )
                ->build())
            ->build();
        $inputPerson2 = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "Jack Kennedy" )
                ->build())
            ->build();
        $personMatchResult = $personMatcher->match($inputPerson1, $inputPerson2);
        $this->assertEquals('MATCHING', (string)$personMatchResult->getPersonMatchType());
    }

    public function testMatch_similar() {
        $personMatcher = $this->makeServiceFactory()->matcherServices()->personMatcher();
        $inputPerson1 = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John F. Kennedy" )
                ->build())
            ->ageInfo( AgeInfoFactory::forDate(1917,5,29) )
            ->build();
        $inputPerson2 = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "Jack Kennedy" )
                ->build())
            ->ageInfo( AgeInfoFactory::forDate(1990,12,31) )
            ->build();
        $personMatchResult = $personMatcher->match($inputPerson1, $inputPerson2);
        $this->assertEquals('SIMILAR', (string)$personMatchResult->getPersonMatchType());
    }

    public function testMatch_different() {
        $personMatcher = $this->makeServiceFactory()->matcherServices()->personMatcher();
        $inputPerson1 = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John F. Kennedy" )
                ->build())
            ->ageInfo( AgeInfoFactory::forDate(1917,5,29) )
            ->build();
        $inputPerson2 = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John Doe" )
                ->build())
            ->ageInfo( AgeInfoFactory::forDate(1990,12,31) )
            ->build();
        $personMatchResult = $personMatcher->match($inputPerson1, $inputPerson2);
        $this->assertEquals('DIFFERENT', (string)$personMatchResult->getPersonMatchType());
    }

}
