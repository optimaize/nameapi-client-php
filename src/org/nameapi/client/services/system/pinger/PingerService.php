<?php

namespace org\nameapi\client\services\system\ping;

use org\nameapi\client\commonwsdl\PriceArguments;
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
     * @return int
     */
    public function price() {
        $parameters = new PriceArguments();
        return $this->soapPingerService->price($parameters)->getReturn();
    }

    /**
     * @return string
     */
    public function ping() {
        $parameters = new wsdl\PingArguments($this->context);
        return $this->soapPingerService->ping($parameters)->getReturn();
    }

}
