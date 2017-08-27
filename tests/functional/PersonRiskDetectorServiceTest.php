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
 */
class PersonRiskDetectorServiceTest extends \PHPUnit_Framework_TestCase {

    public function testDetect() {
        //setup code:
        $context = Context::builder()
            ->priority(Priority::REALTIME())
            ->build();
        $myApiKey = 'test'; //grab one from nameapi.org
        $serviceFactory = new ServiceFactory($myApiKey, $context, Host::http('rc53-api.nameapi.org'), '5.0');
        $riskDetector = $serviceFactory->riskServices()->personRiskDetector();

        //the call:
        $inputPerson = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John Doe" )
                ->build())
            ->gender("FEMALE")
            ->build();
        $riskResult = $riskDetector->detect($inputPerson);

        //the assertions:
        $this->assertTrue($riskResult->getScore() >= 0.8);
        $this->assertTrue($riskResult->getScore() <= 1.0);
        $this->assertTrue($riskResult->hasRisk());

        $this->assertEquals(1, sizeof($riskResult->getRisks()));
        $worstRisk = $riskResult->getRisks()[0];
        $this->assertEquals('NAME', $worstRisk->getDataItem());
        $this->assertEquals('PLACEHOLDER', $riskResult->getRisks()[0]->getRiskType());
        $this->assertTrue($riskResult->getRisks()[0]->getRiskScore() >= 0.8);
        $this->assertTrue($riskResult->getRisks()[0]->getRiskScore() <= 1.0);
    }

}
