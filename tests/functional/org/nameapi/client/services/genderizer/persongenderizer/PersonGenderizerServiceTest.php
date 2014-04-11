<?php

namespace org\nameapi\client\services\genderizer\persongenderizer;

require_once(__DIR__.'/../../BaseServiceTest.php');

use org\nameapi\client\services\BaseServiceTest;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\ontology\input\entities\person\name\InputPersonName;

class PersonGenderizerServiceTest extends BaseServiceTest {

    public function testMale() {
        $personGenderizer = $this->makeServiceFactory()->genderizerServices()->personGenderizer();
        $inputPerson = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John F. Kennedy" )
                ->build())
            ->build();
        $personGenderResult = $personGenderizer->assess($inputPerson);
        $this->assertEquals('MALE', (string)$personGenderResult->getGender());
    }

    public function testFemale() {
        $personGenderizer = $this->makeServiceFactory()->genderizerServices()->personGenderizer();
        $inputPerson = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "Angela Merkel" )
                ->build())
            ->build();
        $personGenderResult = $personGenderizer->assess($inputPerson);
        $this->assertEquals('FEMALE', (string)$personGenderResult->getGender());
    }

}
