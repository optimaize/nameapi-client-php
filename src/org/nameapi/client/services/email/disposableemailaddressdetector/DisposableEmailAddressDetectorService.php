<?php

namespace org\nameapi\client\services\email\disposableemailaddressdetector;

use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\services\BaseService;
use org\nameapi\ontology\input\context\Context;

require_once(__DIR__.'/DisposableEmailAddressDetectorResult.php');
require_once(__DIR__.'/Maybe.php');

/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.3/email/disposableemailaddressdetector
 *
 * HOW TO USE:
 * $deaDetector = $myServiceFactory->emailServices()->disposableEmailAddressDetector();
 * $result = $deaDetector->isDisposable("abcdefgh@10minutemail.com");
 * echo (string)$result->getDisposable()); //prints 'YES'
 *
 * @since v4.0
 */
class DisposableEmailAddressDetectorService extends BaseService {

    private static $RESOURCE_PATH = "email/disposableemailaddressdetector";

    public function __construct($apiKey, Context $context, $baseUrl) {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param string $emailAddress
     * @return DisposableEmailAddressDetectorResult
     * @throws ServiceException
     */
    public function isDisposable($emailAddress) {
        $queryParams = array(
            'emailAddress'=>$emailAddress
        );
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiGet(
            DisposableEmailAddressDetectorService::$RESOURCE_PATH,
            $queryParams, $headerParams
        );
        try {
            return new DisposableEmailAddressDetectorResult(new Maybe($response->disposable));
        } catch (\Exception $e) {
            throw $this->unmarshallingFailed($response, $httpResponseData);
        }
    }

} 