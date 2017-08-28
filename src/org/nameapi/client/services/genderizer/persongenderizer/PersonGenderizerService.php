<?php

namespace org\nameapi\client\services\genderizer\persongenderizer;

use org\nameapi\client\fault\ServiceException;
use org\nameapi\client\services\BaseService;
use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\gender\ComputedPersonGender;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;

require_once(__DIR__.'/PersonGenderResult.php');


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
class PersonGenderizerService extends BaseService {

    private static $RESOURCE_PATH = "genderizer/persongenderizer";

    public function __construct($apiKey, Context $context, $baseUrl) {
        parent::__construct($apiKey, $context, $baseUrl);
    }


    /**
     * @param NaturalInputPerson $person
     * @return PersonGenderResult
     * @throws ServiceException
     */
    public function assess(NaturalInputPerson $person) {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpResponseData) = $this->restHttpClient->callApiPost(
            PersonGenderizerService::$RESOURCE_PATH,
            $queryParams, $headerParams,
            array('inputPerson'=>$person, 'context'=>$this->context)
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
