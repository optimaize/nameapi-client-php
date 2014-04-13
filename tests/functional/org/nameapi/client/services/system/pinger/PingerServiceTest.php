<?php

namespace org\nameapi\client\services\system\ping;

require_once(__DIR__.'/../../BaseServiceTest.php');

use org\nameapi\client\services\BaseServiceTest;

class PingerServiceTest extends BaseServiceTest {

    public function testPing() {
        $pinger = $this->makeServiceFactory()->systemServices()->pinger();
        $result = $pinger->ping();
        $this->assertEquals('pong', $result->getPong());
    }

}
