<?php

namespace org\nameapi\client\fault;

require_once(__DIR__.'/../../../../../../src/org/nameapi/client/fault/FaultInfoUnmarshaller.php');

class FaultInfoUnmarshallerTest extends \PHPUnit_Framework_TestCase {

    public function testDate() {
        $data = "{\"faultCause\":\"AccessDenied\",\"blame\":\"CLIENT\",\"message\":\"No such account: >>>foo<<<!\",\"applicationErrorCode\":\"1201\",\"retrySameLocation\":{\"retryType\":\"NO\"},\"retryOtherLocations\":{\"retryType\":\"NO\"},\"httpStatusCode\":401,\"httpStatusMeaning\":\"Unauthorized\"}";
        $faultInfo = FaultInfoUnmarshaller::unmarshallJsonString($data);
        $this->assertEquals("AccessDenied",   $faultInfo->getFaultCause());
        $this->assertTrue($faultInfo->getBlame()->isClient());
        $this->assertEquals("No such account: >>>foo<<<!",   $faultInfo->getMessage());
        $this->assertEquals("1201",   $faultInfo->getApplicationErrorCode());
        $this->assertEquals(null,   $faultInfo->getIncidentId());
    }

}
