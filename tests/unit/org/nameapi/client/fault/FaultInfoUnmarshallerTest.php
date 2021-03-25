<?php

namespace Tests\Unit\Org\NameApi\Client\Fault;

use Org\NameApi\Client\Fault\FaultInfoUnmarshaller;
use PHPUnit\Framework\TestCase;

class FaultInfoUnmarshallerTest extends TestCase
{

    public function testDate()
    {
        $data = "{\"faultCause\":\"AccessDenied\",\"blame\":\"CLIENT\",\"message\":\"No such account: >>>foo<<<!\",\"applicationErrorCode\":\"1201\",\"retrySameLocation\":{\"retryType\":\"NO\"},\"retryOtherLocations\":{\"retryType\":\"NO\"},\"httpStatusCode\":401,\"httpStatusMeaning\":\"Unauthorized\"}";
        $faultInfo = FaultInfoUnmarshaller::unmarshallJsonString($data);
        $this->assertEquals("AccessDenied", $faultInfo->getFaultCause());
        $this->assertTrue($faultInfo->getBlame()->isClient());
        $this->assertEquals("No such account: >>>foo<<<!", $faultInfo->getMessage());
        $this->assertEquals("1201", $faultInfo->getApplicationErrorCode());
        $this->assertEquals(null, $faultInfo->getIncidentId());
    }

}
