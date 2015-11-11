<?php

namespace org\nameapi\client\services\system\ping;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\client\lib\RestHttpClient;
use org\nameapi\client\lib\Configuration;
use org\nameapi\client\lib\ApiException;


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.0/system/ping
 *
 * HOW TO USE:
 * $ping = $myServiceFactory->systemServices()->pingService();
 * $pong = $ping->ping();
 */
class PingService {

    private static $RESOURCE_PATH = "system/ping";

    private $context;
    /**
     * @var RestHttpClient
     */
    private $restHttpClient;

    /**
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->context = $context;
        $configuration = new Configuration();
        $configuration->setApiKey($apiKey);
        $configuration->setBaseUrl($baseUrl);
        $this->restHttpClient = new RestHttpClient($configuration);
    }

    /**
     * @return string
     */
    public function ping() {
        $queryParams = array();
        $headerParams = array();

        // make the API Call
        try {
            list($response, $httpHeader) = $this->restHttpClient->callApiGet(
                PingService::$RESOURCE_PATH,
                $queryParams,
                $headerParams,
                'string'
            );

            //TODO why deserialize again???
            return $this->restHttpClient->getSerializer()->deserialize($response, 'string');
        } catch (ApiException $e) { //TODO other exceptions could be thrown, who translates them to ApiException???
            switch ($e->getCode()) {
                //TODO why would a 200 be an exception???
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), 'string', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

}
