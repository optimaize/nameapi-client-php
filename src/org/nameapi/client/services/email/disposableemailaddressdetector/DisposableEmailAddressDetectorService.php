<?php

namespace org\nameapi\client\services\email\disposableemailaddressdetector;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\lib\RestHttpClient;
use org\nameapi\client\lib\Configuration;
use org\nameapi\client\lib\ApiException;

require_once(__DIR__.'/DisposableEmailAddressDetectorResult.php');
require_once(__DIR__.'/Maybe.php');

/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.0/email/disposableemailaddressdetector
 *
 * HOW TO USE:
 * $deaDetector = $myServiceFactory->emailServices()->disposableEmailAddressDetector();
 * $result = $deaDetector->isDisposable("abcdefgh@10minutemail.com");
 * echo (string)$result->getDisposable()); //prints 'YES'
 *
 * @since v4.0
 */
class DisposableEmailAddressDetectorService {

    private static $RESOURCE_PATH = "email/disposableemailaddressdetector";

    private $context;

    /**
     * @var RestHttpClient
     */
    private $restHttpClient;

    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->context = $context;
        $configuration = new Configuration();
        $configuration->setApiKey($apiKey);
        $configuration->setBaseUrl($baseUrl);
        $this->restHttpClient = new RestHttpClient($configuration);
    }

    /**
     * @param string $emailAddress
     * @return DisposableEmailAddressDetectorResult
     */
    public function isDisposable($emailAddress) {
        $queryParams = array(
            'emailAddress'=>$emailAddress
        );
        $headerParams = array();

        list($response, $httpHeader) = $this->restHttpClient->callApiGet(
            DisposableEmailAddressDetectorService::$RESOURCE_PATH,
            $queryParams,
            $headerParams
        );
        try {
            return new DisposableEmailAddressDetectorResult(new Maybe($response->disposable));
        } catch (\Exception $e) {
            throw new ApiException("Server sent unexpected or unsupported response: ".$e->getMessage(), 500);
        }
    }

} 