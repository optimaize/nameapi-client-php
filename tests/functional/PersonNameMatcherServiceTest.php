<?php

require '../../src/org/nameapi/client/services/ServiceFactory.php';
use org\nameapi\client\services\Host;
use org\nameapi\client\services\ServiceFactory;
use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\context\Priority;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\ontology\input\entities\person\name\InputPersonName;
use PHPUnit\Framework\TestCase;


/**
 *
 * This is just one simple call. For all functional tests see the separate project at
 * https://github.com/optimaize/nameapi-client-php-functionaltests
 *
 *
 */
class PersonNameMatcherServiceTest extends TestCase {

    public function testMatch() {
        //setup code:
        $context = Context::builder()
            ->priority(Priority::REALTIME())
            ->build();
        $myApiKey = 'your-api-key'; //grab one from nameapi.org
        $serviceFactory = new ServiceFactory($myApiKey, $context, Host::http('api.nameapi.org'), '5.3');
        $personNameMatcher = $serviceFactory->matcherServices()->personMatcher();

        //the call:
        $inputPerson1 = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John F. Kennedy" )
                ->build())
            ->gender("MALE")
            ->build();

        //the call:
        $inputPerson2 = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John Fitzgerald Kennedy" )
                ->build())
            ->gender("MALE")
            ->build();

        $matchResult = $personNameMatcher->match($inputPerson1, $inputPerson2);

        //the assertions:
        $this->assertEquals('MATCHING', (string)$matchResult->getMatchType());
        $this->assertTrue($matchResult->getPoints() >= 0.55 && $matchResult->getPoints() <= 1.0);
        $this->assertEquals('MATCHING', (string)$matchResult->getPersonNameMatcherResult()->getMatchType());
        $this->assertEquals('FULL', (string)$matchResult->getMatchComposition());
        $this->assertEquals('EQUAL', (string)$matchResult->getGenderMatcherResult()->getMatchType());
        $this->assertEquals('NOT_APPLICABLE', (string)$matchResult->getAgeMatcherResult()->getMatchType());
    }

}
