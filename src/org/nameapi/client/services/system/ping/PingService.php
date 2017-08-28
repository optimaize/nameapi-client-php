<?php

namespace org\nameapi\client\services\system\ping;

use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\services\BaseService;
use org\nameapi\ontology\input\context\Context;


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.3/system/ping
 *
 * HOW TO USE:
 * $ping = $myServiceFactory->systemServices()->pingService();
 * $pong = $ping->ping();
 */
class PingService extends BaseService {

    private static $RESOURCE_PATH = "system/ping";

    public function __construct($apiKey, Context $context, $baseUrl) {
        parent::__construct($apiKey, $context, $baseUrl);
    }

    /**
     * @return string 'pong'
     * @throws ServiceException
     */
    public function ping() {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiGet(
            PingService::$RESOURCE_PATH,
            $queryParams, $headerParams
        );
        if ($response !== 'pong') {
            throw $this->unmarshallingFailed($response, $httpResponseData);
        }
        return $response;
    }

}
