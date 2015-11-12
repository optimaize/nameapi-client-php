<?php

namespace org\nameapi\client\services\formatter\namefieldformatter;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\name\NameField;
use org\nameapi\client\services\formatter\FormatterProperties;
use org\nameapi\client\services\formatter\FormatterResult;
use org\nameapi\client\lib\RestHttpClient;
use org\nameapi\client\lib\Configuration;
use org\nameapi\client\lib\ApiException;



/**
 *
 */
class NameFieldFormatterService {

    private static $RESOURCE_PATH = "formatter/namefieldformatter";

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
     * @param NameField $nameField
     * @param FormatterProperties $properties
     * @return FormatterResult
     */
    public function format(NameField $nameField, FormatterProperties $properties) {
        throw new ApiException("Method not implemented as of now.", 501);
    }

} 