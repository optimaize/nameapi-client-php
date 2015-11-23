<?php

require '../../src/org/nameapi/client/services/ServiceFactory.php';
use org\nameapi\client\services\Host;
use org\nameapi\client\services\ServiceFactory;
use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\context\Priority;


/**
 *
 * This is just one simple call. For all functional tests see the separate project at
 * https://github.com/optimaize/nameapi-client-php-functionaltests
 *
 *
 */
class PingServiceTest extends \PHPUnit_Framework_TestCase {

    public function testPing() {
        //setup code:
        $context = Context::builder()
            ->priority(Priority::REALTIME())
            ->build();
        $myApiKey = 'test'; //grab one from nameapi.org
        $serviceFactory = new ServiceFactory($myApiKey, $context, Host::http('preview-api.nameapi.org'), '5.0');
        $deaDetector = $serviceFactory->emailServices()->disposableEmailAddressDetector();

        //the call:
        $pingService = $serviceFactory->systemServices()->ping();
        $result = $pingService->ping();
        $this->assertEquals('pong', $result);
    }

}
