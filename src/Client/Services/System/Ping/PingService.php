<?php

namespace Org\NameApi\Client\Services\System\Ping;

use Org\NameApi\Client\Fault\ServiceException;
use Org\NameApi\Client\Services\BaseService;
use Org\NameApi\Ontology\Input\Context\Context;


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.3/system/ping
 *
 * HOW TO USE:
 * $ping = $myServiceFactory->systemServices()->pingService();
 * $pong = $ping->ping();
 */
class PingService extends BaseService
{

    private static $RESOURCE_PATH = "system/ping";

    public function __construct($apiKey, Context $context, $baseUrl)
    {
        parent::__construct($apiKey, $context, $baseUrl);
    }

    /**
     * @return string 'pong'
     * @throws ServiceException
     */
    public function ping()
    {
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
