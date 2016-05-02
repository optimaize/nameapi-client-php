<?php

require '../../src/org/nameapi/client/services/ServiceFactory.php';
use org\nameapi\client\services\Host;
use org\nameapi\client\services\ServiceFactory;
use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\context\Priority;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\ontology\input\entities\person\name\InputPersonName;


/**
 *
 * This is just one simple call. For all functional tests see the separate project at
 * https://github.com/optimaize/nameapi-client-php-functionaltests
 *
 *
 */
class PersonNameParserServiceTest extends \PHPUnit_Framework_TestCase {

    public function testParse() {
        //setup code:
        $context = Context::builder()
            ->priority(Priority::REALTIME())
            ->build();
        $myApiKey = 'test'; //grab one from nameapi.org
        $serviceFactory = new ServiceFactory($myApiKey, $context, Host::http('rc50-api.nameapi.org'), '5.0');
        $personNameParser = $serviceFactory->parserServices()->personNameParser();

        //the call:
        $inputPerson = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John Doe" )
                ->build())
            ->gender(new org\nameapi\ontology\input\entities\person\gender\StoragePersonGender("FEMALE"))
            ->build();
        $parseResult = $personNameParser->parse($inputPerson);

        //the assertions:
        $bestMatch = $parseResult->getBestMatch();
        $this->assertEquals('NATURAL', (string)$bestMatch->getParsedPerson()->getPersonType());
        $this->assertEquals('PRIMARY', (string)$bestMatch->getParsedPerson()->getPersonRole());
        $this->assertEquals('John', $bestMatch->getParsedPerson()->getAddressingGivenName());
        $this->assertEquals('Doe', $bestMatch->getParsedPerson()->getAddressingSurname());
        $this->assertEquals('John', $bestMatch->getParsedPerson()->getOutputPersonName()->getFirst('GIVENNAME')->getString());
        $this->assertEquals('Doe', $bestMatch->getParsedPerson()->getOutputPersonName()->getFirst('SURNAME')->getString());
    }

}
