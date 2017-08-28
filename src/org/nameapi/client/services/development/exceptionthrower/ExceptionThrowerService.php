<?php

namespace org\nameapi\client\services\development\exceptionthrower;

use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\services\BaseService;
use org\nameapi\ontology\input\context\Context;


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.3/development/exceptionthrower
 *
 * <p>The use is for development only; to see what happens when the server throws exceptions, and how they arrive
 * at your end.</p>
 *
 * HOW TO USE:
 * $exceptionThrower = $myServiceFactory->developmentServices()->exceptionThrowerService();
 * $exceptionThrower = $ping->throwException();
 */
class ExceptionThrowerService extends BaseService {


    private static $RESOURCE_PATH = "development/exceptionthrower";

    public function __construct($apiKey, Context $context, $baseUrl) {
        parent::__construct($apiKey, $context, $baseUrl);
    }

    /**
     * @param string $exceptionType   One of 'AccessDeniedNoSuchAccount', 'InvalidInput', 'InternalServerError'
     * @param int $exceptionChance    0-100 where 100 means always
     * @return string                 'OK' in case the remote service does not throw.
     * @throws ServiceException
     */
    public function throwException($exceptionType, $exceptionChance) {
        $queryParams = array(
            'exceptionType'   => $exceptionType,
            'exceptionChance' => $exceptionChance,
        );
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiGet(
            ExceptionThrowerService::$RESOURCE_PATH,
            $queryParams, $headerParams
        );
        if ($response !== 'OK') {
            throw $this->unmarshallingFailed($response, $httpResponseData);
        }
        return $response;
    }

}