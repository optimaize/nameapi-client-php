<?php

namespace org\nameapi\client\services\genderizer\persongenderizer;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;
use org\nameapi\client\lib\RestHttpClient;
use org\nameapi\client\lib\Configuration;
use org\nameapi\client\lib\ApiException;
use \org\nameapi\ontology\input\entities\person\gender\ComputedPersonGender;

require_once(__DIR__.'/PersonGenderResult.php');


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/rest/v5.0/genderizer/persongenderizer
 *
 * HOW TO USE:
 * $personGenderizer = $myServiceFactory->genderizerServices()->personGenderizer();
 * $personGenderResult = $personGenderizer->assess($inputPerson);
 * echo (string)$personGenderResult->getGender(); //prints 'MALE'
 *
 * @since v4.0
 */
class PersonGenderizerService {

    private static $RESOURCE_PATH = "genderizer/persongenderizer";

    private $context;

    /**
     * @var RestHttpClient
     */
    private $restHttpClient;


    /**
     * @access public
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->context = $context;
        $configuration = new Configuration();
        $configuration->setApiKey($apiKey);
        $configuration->setBaseUrl($baseUrl);
        $this->restHttpClient = new RestHttpClient($configuration);
    }

    /**
     * @param NaturalInputPerson $person
     * @return PersonGenderResult
     */
    public function assess(NaturalInputPerson $person) {
        $queryParams = array();
        $headerParams = array();

        list($response, $httpHeader) = $this->restHttpClient->callApiPost(
            PersonGenderizerService::$RESOURCE_PATH,
            $queryParams,
            $headerParams,
            ['inputPerson'=>$person, 'context'=>$this->context]
        );
        try {
            return new PersonGenderResult(new ComputedPersonGender(
                $response->gender),
                (isset($response->maleProportion) ? $response->maleProportion : null),
                $response->confidence
            );
        } catch (\Exception $e) {
            throw new ApiException("Server sent unexpected or unsupported response: ".$e->getMessage(), 500);
        }
    }

}
