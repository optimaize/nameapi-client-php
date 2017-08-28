<?php

namespace org\nameapi\client\services\formatter\personnameformatter;

use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\services\BaseService;
use org\nameapi\client\services\formatter\FormatterProperties;
use org\nameapi\client\services\formatter\FormatterResult;
use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;

require_once(__DIR__.'/../FormatterResult.php');
require_once(__DIR__.'/../FormatterProperties.php');



/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.3/formatter/personnameformatter
 *
 * HOW TO USE:
 * $personNameFormatter = $myServiceFactory->formatterServices()->personNameFormatter();
 * $formatterResult = $personNameFormatter->format($myInputPerson, $myParams);
 *
 * @since v4.0
 */
class PersonNameFormatterService extends BaseService {

    private static $RESOURCE_PATH = "formatter/personnameformatter";

    public function __construct($apiKey, Context $context, $baseUrl) {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param NaturalInputPerson $person
     * @param FormatterProperties $properties
     * @return FormatterResult
     * @throws ServiceException
     */
    public function format(NaturalInputPerson $person, FormatterProperties $properties) {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiPost(
            PersonNameFormatterService::$RESOURCE_PATH,
            $queryParams, $headerParams,
            array('inputPerson'=>$person, 'properties'=>$properties, 'context'=>$this->context)
        );
        try {
            return new FormatterResult($response->formatted, $response->unknown);
        } catch (\Exception $e) {
            throw $this->unmarshallingFailed($response, $httpResponseData);
        }
    }

} 