<?php

namespace Org\NameApi\Client\Services\Formatter\PersonNameFormatter;

use Org\NameApi\Client\Fault\ServiceException;
use Org\NameApi\Client\Services\BaseService;
use Org\NameApi\Client\Services\Formatter\FormatterProperties;
use Org\NameApi\Client\Services\Formatter\FormatterResult;
use Org\NameApi\Ontology\Input\Context\Context;
use Org\NameApi\Ontology\Input\Entities\Person\NaturalInputPerson;

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
class PersonNameFormatterService extends BaseService
{

    private static $RESOURCE_PATH = "formatter/personnameformatter";

    public function __construct($apiKey, Context $context, $baseUrl)
    {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param NaturalInputPerson $person
     * @param FormatterProperties $properties
     * @return FormatterResult
     * @throws ServiceException
     */
    public function format(NaturalInputPerson $person, FormatterProperties $properties)
    {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiPost(
            PersonNameFormatterService::$RESOURCE_PATH,
            $queryParams, $headerParams,
            array('inputPerson' => $person, 'properties' => $properties, 'context' => $this->context)
        );
        try {
            return new FormatterResult($response->formatted, $response->unknown);
        } catch (\Exception $e) {
            throw $this->unmarshallingFailed($response, $httpResponseData);
        }
    }

}
