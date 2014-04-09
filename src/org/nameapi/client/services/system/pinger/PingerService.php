<?php

namespace org\nameapi\client\services\system\ping;

use org\nameapi\ontology\input\context\Context;

require_once('wsdl/SoapPingerService.php');


/**
 *
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
