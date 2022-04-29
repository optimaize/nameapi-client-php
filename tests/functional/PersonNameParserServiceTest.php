<?php

namespace Tests\Functional;

use Org\NameApi\Client\Services\Host;
use Org\NameApi\Client\Services\ServiceFactory;
use Org\NameApi\Ontology\Input\Context\Context;
use Org\NameApi\Ontology\Input\Context\Priority;
use Org\NameApi\Ontology\Input\Entities\Person\Name\InputPersonName;
use Org\NameApi\Ontology\Input\Entities\Person\NaturalInputPerson;
use PHPUnit\Framework\TestCase;


/**
 *
 * This is just one simple call. For all functional tests see the separate project at
 * https://github.com/optimaize/nameapi-client-php-functionaltests
 *
 *
 */
class PersonNameParserServiceTest extends TestCase
{

    public function testParse()
    {
        //setup code:
        $context = Context::builder()
            ->priority(Priority::REALTIME())
            ->build();
        $myApiKey = 'test'; //grab one from nameapi.org
        $serviceFactory = new ServiceFactory($myApiKey, $context, Host::http('rc53-api.nameapi.org'), '5.3');
        $personNameParser = $serviceFactory->parserServices()->personNameParser();

        //the call:
        $inputPerson = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname("John Doe")
                ->build())
            ->gender("FEMALE")
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

        $this->assertEquals(1, sizeof($bestMatch->getParserDisputes()));
        $this->assertEquals('GENDER', (string)$bestMatch->getParserDisputes()[0]->getDisputeType());
    }

    public function test_parseTwoPeople()
    {
        //setup code:
        $context = Context::builder()
            ->priority(Priority::REALTIME())
            ->build();
        $myApiKey = 'test'; //grab one from nameapi.org
        $serviceFactory = new ServiceFactory($myApiKey, $context, Host::http('rc53-api.nameapi.org'), '5.3');
        $personNameParser = $serviceFactory->parserServices()->personNameParser();

        //the call:
        $inputPerson = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname("Peter und Daniela Meyer")
                ->build())
            ->build();
        $parseResult = $personNameParser->parse($inputPerson);

        //the assertions:
        $bestMatch = $parseResult->getBestMatch();
        $this->assertEquals('MULTIPLE', (string)$bestMatch->getParsedPerson()->getPersonType());
        $people = $bestMatch->getParsedPerson()->getPeople();
        $this->assertEquals(2, sizeof($people));

        $firstPerson = $people[0];
        $this->assertEquals('Peter', $firstPerson->getAddressingGivenName());
        $this->assertEquals('Meyer', $firstPerson->getAddressingSurname());
        $this->assertEquals('MALE', (string)$firstPerson->getGender()->getGender());

        $secondPerson = $people[1];
        $this->assertEquals('Daniela', $secondPerson->getAddressingGivenName());
        $this->assertEquals('Meyer', $secondPerson->getAddressingSurname());
        $this->assertEquals('FEMALE', (string)$secondPerson->getGender()->getGender());
    }

}
