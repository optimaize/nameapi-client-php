<?php

namespace Org\NameApi\Client\Services\Genderizer\PersonGenderizer;

use Org\NameApi\Client\Fault\ServiceException;
use Org\NameApi\Client\Services\BaseService;
use Org\NameApi\Ontology\Input\Context\Context;
use Org\NameApi\Ontology\Input\Entities\Person\Gender\ComputedPersonGender;
use Org\NameApi\Ontology\Input\Entities\Person\NaturalInputPerson;

/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.3/genderizer/persongenderizer
 *
 * HOW TO USE:
 * $personGenderizer = $myServiceFactory->genderizerServices()->personGenderizer();
 * $personGenderResult = $personGenderizer->assess($inputPerson);
 * echo (string)$personGenderResult->getGender(); //prints 'MALE'
 *
 * @since v4.0
 */
class PersonGenderizerService extends BaseService
{

    private static $RESOURCE_PATH = "genderizer/persongenderizer";

    public function __construct($apiKey, Context $context, $baseUrl)
    {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param NaturalInputPerson $person
     * @return PersonGenderResult
     * @throws ServiceException
     */
    public function assess(NaturalInputPerson $person)
    {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiPost(
            PersonGenderizerService::$RESOURCE_PATH,
            $queryParams, $headerParams,
            array('inputPerson' => $person, 'context' => $this->context)
        );
        try {
            return new PersonGenderResult(new ComputedPersonGender(
                $response->gender),
                (isset($response->maleProportion) ? $response->maleProportion : null),
                $response->confidence
            );
        } catch (\Exception $e) {
            throw $this->unmarshallingFailed($response, $httpResponseData);
        }
    }

}
