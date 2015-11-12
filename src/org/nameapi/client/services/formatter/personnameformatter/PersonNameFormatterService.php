<?php

namespace org\nameapi\client\services\formatter\personnameformatter;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\client\services\formatter\FormatterProperties;
use org\nameapi\client\services\formatter\FormatterResult;
use org\nameapi\client\lib\RestHttpClient;
use org\nameapi\client\lib\Configuration;
use org\nameapi\client\lib\ApiException;

require_once(__DIR__.'/../FormatterResult.php');
require_once(__DIR__.'/../FormatterProperties.php');



/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.0/formatter/personnameformatter
 *
 * HOW TO USE:
 * $personNameFormatter = $myServiceFactory->formatterServices()->personNameFormatter();
 * $formatterResult = $personNameFormatter->format($myInputPerson, $myParams);
 *
 * @since v4.0
 */
class PersonNameFormatterService {

    private static $RESOURCE_PATH = "formatter/personnameformatter";

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
     * @param NaturalInputPerson $person
     * @param FormatterProperties $properties
     * @return FormatterResult
     */
    public function format(NaturalInputPerson $person, FormatterProperties $properties) {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpHeader) = $this->restHttpClient->callApiPost(
            PersonNameFormatterService::$RESOURCE_PATH,
            $queryParams,
            $headerParams,
            ['inputPerson'=>$person, 'properties'=>$properties, 'context'=>$this->context]
        );
        try {
            return new FormatterResult($response->formatted, $response->unknown);
        } catch (\Exception $e) {
            throw new ApiException("Server sent unexpected or unsupported response: ".$e->getMessage(), 500);
        }
    }

} 