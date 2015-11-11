<?php

namespace org\nameapi\client\services\system\ping;

require_once(__DIR__.'/../../BaseServiceTest.php');

use org\nameapi\client\services\BaseServiceTest;

class PingServiceTest extends BaseServiceTest {

    public function testPing() {
        $ping = $this->makeServiceFactory()->systemServices()->ping();
        $result = $ping->ping();
        $this->assertEquals('pong', $result);
    }

}
