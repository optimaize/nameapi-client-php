<?php

namespace org\nameapi\client\services;

require_once(__DIR__.'/../fault/FaultInfo.php');

use org\nameapi\client\fault\Blame;
use org\nameapi\client\fault\FaultInfo;
use org\nameapi\client\fault\Retry;
use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\http\RestHttpClient;
use org\nameapi\client\http\RestHttpClientConfig;
use org\nameapi\ontology\input\context\Context;

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
    public function __construct($apiKey, Context $context, $baseUrl) {
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