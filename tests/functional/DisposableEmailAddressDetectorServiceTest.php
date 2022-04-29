<?php

namespace Tests\Functional;

use Org\NameApi\Client\Services\Host;
use Org\NameApi\Client\Services\ServiceFactory;
use Org\NameApi\Ontology\Input\Context\Context;
use Org\NameApi\Ontology\Input\Context\Priority;
use PHPUnit\Framework\TestCase;


/**
 *
 * This is just one simple call. For all functional tests see the separate project at
 * https://github.com/optimaize/nameapi-client-php-functionaltests
 *
 *
 */
class DisposableEmailAddressDetectorServiceTest extends TestCase
{

    public function testDea()
    {
        //setup code:
        $context = Context::builder()
            ->priority(Priority::REALTIME())
            ->build();
        $myApiKey = 'test'; //grab one from nameapi.org
        $serviceFactory = new ServiceFactory($myApiKey, $context, Host::http('rc53-api.nameapi.org'), '5.3');

        //the call:
        $deaDetector = $serviceFactory->emailServices()->disposableEmailAddressDetector();
        $result = $deaDetector->isDisposable("abcdefgh@10minutemail.com");

        //the assertions:
        $this->assertEquals('YES', (string)$result->getDisposable());
    }

}
