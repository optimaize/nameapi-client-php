<?php

namespace org\nameapi\client\services\email\disposableemailaddressdetector;

use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/wsdl/SoapDisposableEmailAddressDetectorService.php');
require_once(__DIR__.'/DisposableEmailAddressDetectorResult.php');
require_once(__DIR__.'/Maybe.php');

/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/soap/v4.0/email/disposableemailaddressdetector?wsdl
 *
 * HOW TO USE:
 * $deaDetector = $myServiceFactory->emailServices()->disposableEmailAddressDetector();
 * $result = $deaDetector->isDisposable("abcdefgh@10minutemail.com");
 * echo (string)$result->getDisposable()); //prints 'YES'
 */
class DisposableEmailAddressDetectorService {

    private $context;
    private $soapDisposableEmailAddressDetectorService;

    public function __construct(Context $context, $baseUrl) {
        $this->context = $context;
        $this->soapDisposableEmailAddressDetectorService = new wsdl\SoapDisposableEmailAddressDetectorService(array(), $baseUrl);
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