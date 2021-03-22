<?php

namespace Org\NameApi\Client\Services;

use Org\NameApi\Client\Fault\Blame;
use Org\NameApi\Client\Fault\FaultInfo;
use Org\NameApi\Client\Fault\Retry;
use Org\NameApi\Client\Fault\ServiceException;
use Org\NameApi\Client\Http\RestHttpClient;
use Org\NameApi\Client\Http\RestHttpClientConfig;
use Org\NameApi\Ontology\Input\Context\Context;

/**
 * Base class for services.
 */
abstract class BaseService
{

    protected $context;

    /**
     * @var RestHttpClient
     */
    protected $restHttpClient;


    /**
     * @access public
     * @param $apiKey
     * @param Context $context
     * @param $baseUrl
     */
    public function __construct($apiKey, Context $context, $baseUrl)
    {
        $this->context = $context;
        $configuration = new RestHttpClientConfig();
        $configuration->setApiKey($apiKey);
        $configuration->setBaseUrl($baseUrl);
        $this->restHttpClient = new RestHttpClient($configuration);
    }


    /**
     * @param $response
     * @param $httpResponseData
     * @return ServiceException
     */
    protected function unmarshallingFailed($response, $httpResponseData)
    {
        $faultInfo = new FaultInfo(
            'BadRequest', new Blame('CLIENT'),
            'Server sent unexpected or unsupported response!',
            1100, null,
            Retry::no(), Retry::no()
        );
        return new ServiceException($faultInfo->getMessage(), $faultInfo, $httpResponseData);
    }

}
