<?php

require '../../src/org/nameapi/client/services/ServiceFactory.php';
use org\nameapi\client\services\Host;
use org\nameapi\client\services\ServiceFactory;
use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\context\Priority;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\ontology\input\entities\person\name\InputPersonName;
use org\nameapi\ontology\input\entities\address\StructuredAddress;
use org\nameapi\ontology\input\entities\address\StructuredStreetInfo;
use org\nameapi\ontology\input\entities\address\StructuredPlaceInfo;


/**
 *
 * This is just one simple call. For all functional tests see the separate project at
 * https://github.com/optimaize/nameapi-client-php-functionaltests
 */
class PersonRiskDetectorServiceTest extends \PHPUnit_Framework_TestCase {

    /**
     * In this test only the person's name is sent to the server.
     */
    public function testDetect() {
        //setup code:
        $context = Context::builder()
            ->priority(Priority::REALTIME())
            ->build();
        $myApiKey = 'test'; //grab one from nameapi.org
        $serviceFactory = new ServiceFactory($myApiKey, $context, Host::http('rc53-api.nameapi.org'), '5.3');
        $riskDetector = $serviceFactory->riskServices()->personRiskDetector();

        //the call:
        $inputPerson = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->fullname( "John Doe" )
                ->build())
            ->gender("FEMALE")
            ->build();
        $riskResult = $riskDetector->detect($inputPerson);
        //var_dump($riskResult);

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


    /**
     * In this test all fields are filled:
     *  - the person's name
     *  - an email address
     *  - a telephone number
     *  - a physical address
     */
    public function testDetect_allValues() {
        $context = Context::builder()
            ->priority(Priority::REALTIME())
            ->build();
        $myApiKey = 'test'; //grab one from nameapi.org
        $serviceFactory = new ServiceFactory($myApiKey, $context, Host::http('rc53-api.nameapi.org'), '5.3');
        $riskDetector = $serviceFactory->riskServices()->personRiskDetector();

        $inputPerson = NaturalInputPerson::builder()
            ->name(InputPersonName::westernBuilder()
                ->givenName( "Donald" )
                ->surname( "Duck" )
                ->build())
            ->addEmailAddress("info@example.com")
            ->addTelNumber("999 999 999")
            ->addAddressForAll(StructuredAddress::builder()
                ->streetInfo(StructuredStreetInfo::builder()
                    ->streetName("Winzenheimer Str.")
                    ->houseNumber("5")
                    ->build())
                ->placeInfo(StructuredPlaceInfo::builder()
                    ->postalCode("55555")
                    ->locality("Atlantis")
                    ->build())
                ->build())
            ->build();

        $result = $riskDetector->detect($inputPerson);
        //var_dump($result);

        $this->assertEquals(true, $result->hasRisk());
        $this->assertEquals(4, sizeof($result->getRisks()));
        $this->assertTrue($result->getScore() >= 0.95 && $result->getScore() <= 1.0);

        $this->_expectRiskOnName($result->getRisks());
        $this->_expectRiskOnAddress($result->getRisks());
        $this->_expectRiskOnEmail($result->getRisks());
        $this->_expectRiskOnTel($result->getRisks());
        $firstRisk = $result->getRisks()[0];
        $this->assertTrue($firstRisk->getRiskScore() >= 0.9 && $firstRisk->getRiskScore() <= 1.0);
        $this->assertEquals('NAME', (string)$firstRisk->getDataItem());
        $this->assertEquals('FICTIONAL', (string)$firstRisk->getRiskType());
    }


    private function _expectRiskOnName($risks) {
        foreach ($risks as $risk) {
            if ((string)$risk->getDataItem() === 'NAME') {
                return;
            }
        }
        $this->assertTrue(false); //fail
    }

    private function _expectRiskOnAddress($risks) {
        foreach ($risks as $risk) {
            if ((string)$risk->getDataItem() === 'ADDRESS') {

                return;
            }
        }
        $this->assertTrue(false); //fail
    }

    private function _expectRiskOnEmail($risks) {
        foreach ($risks as $risk) {
            if ((string)$risk->getDataItem() === 'EMAIL') {

                return;
            }
        }
        $this->assertTrue(false); //fail
    }

    private function _expectRiskOnTel($risks) {
        foreach ($risks as $risk) {
            if ((string)$risk->getDataItem() === 'TEL') {

                return;
            }
        }
        $this->assertTrue(false); //fail
    }



}
