<?php

namespace org\nameapi\client\services\system\ping;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/wsdl/SoapPingerService.php');


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/soap/v4.0/system/pinger?wsdl
 *
 * HOW TO USE:
 * $pinger = $myServiceFactory->systemServices()->pingerService();
 * $pong = $pinger->ping();
 */
class PingerService {

    private $context;
    private $soapPingerService;

    /**
     */
    public function __construct(Context $context) {
        $this->context = $context;
        $this->soapPingerService = new wsdl\SoapPingerService();
    }

    /**
     * @return string
     */
    public function ping() {
        $parameters = new wsdl\PingArguments($this->context);
        return $this->soapPingerService->ping($parameters)->getReturn();
    }

}
