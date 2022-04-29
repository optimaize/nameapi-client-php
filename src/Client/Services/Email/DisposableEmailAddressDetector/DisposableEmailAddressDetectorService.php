<?php

namespace Org\NameApi\Client\Services\Email\DisposableEmailAddressDetector;

use Org\NameApi\Client\Fault\ServiceException;
use Org\NameApi\Client\Services\BaseService;
use Org\NameApi\Ontology\Input\Context\Context;

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
class DisposableEmailAddressDetectorService extends BaseService
{

    private static $RESOURCE_PATH = "email/disposableemailaddressdetector";

    public function __construct($apiKey, Context $context, $baseUrl)
    {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param string $emailAddress
     * @return DisposableEmailAddressDetectorResult
     * @throws ServiceException
     */
    public function isDisposable($emailAddress)
    {
        $queryParams = array(
            'emailAddress' => $emailAddress
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
