<?php

namespace org\nameapi\client\services\system\ping;

require_once(__DIR__.'/../../BaseServiceTest.php');

use org\nameapi\client\services\BaseServiceTest;
use org\nameapi\client\services\ServiceFactory;

class PingerServiceTest extends BaseServiceTest {

    public function testPing() {
        $serviceFactory = new ServiceFactory($this->makeContext());
        $pinger = $serviceFactory->systemServices()->pingerService();
        $pong = $pinger->ping();
        $this->assertEquals($pong, 'pong');
    }

}
