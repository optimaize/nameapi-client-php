<?php

namespace org\nameapi\client\services\email\disposableemailaddressdetector;

use org\nameapi\ontology\input\context\Context;

require_once('wsdl/SoapDisposableEmailAddressDetectorService.php');
require_once('DisposableEmailAddressDetectorResult.php');
require_once('Maybe.php');

/**
 */
class DisposableEmailAddressDetectorService {

    private $context;
    private $soapDisposableEmailAddressDetectorService;

    public function __construct(Context $context) {
        $this->context = $context;
        $this->soapDisposableEmailAddressDetectorService = new wsdl\SoapDisposableEmailAddressDetectorService();
    }

    /**
     * @param string $emailAddress
     * @return DisposableEmailAddressDetectorResult
     */
    public function isDisposable($emailAddress) {
        $parameters = new wsdl\DisposableEmailAddressDetectorArguments($this->context, $emailAddress);
        $result = $this->soapDisposableEmailAddressDetectorService->isDisposable($parameters);
        return new DisposableEmailAddressDetectorResult($result->return->disposable);
    }

} 