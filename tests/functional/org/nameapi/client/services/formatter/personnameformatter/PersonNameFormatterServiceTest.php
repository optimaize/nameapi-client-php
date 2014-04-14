<?php

namespace org\nameapi\client\services\formatter\personnameformatter;

require_once(__DIR__.'/../../BaseServiceTest.php');

use org\nameapi\client\services\BaseServiceTest;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\ontology\input\entities\person\name\InputPersonName;
use org\nameapi\client\services\formatter\FormatterProperties;

class PersonNameFormatterServiceTest extends BaseServiceTest {

    public function testFormat() {
        $personNameFormatter = $this->makeServiceFactory()->formatterServices()->personNameFormatter();
        $inputPerson = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "john f. kennedy" )
                ->build())
            ->build();
        $formatterResult = $personNameFormatter->format($inputPerson, new FormatterProperties());
        $this->assertEquals('John F. Kennedy', $formatterResult->getFormatted());
    }

}
