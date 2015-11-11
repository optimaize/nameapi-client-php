<?php

namespace org\nameapi\client\services\genderizer\persongenderizer;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;

require_once(__DIR__.'/wsdl/SoapPersonGenderizerService.php');
require_once(__DIR__.'/PersonGenderResult.php');


/**
 * This is the service class for the web service offered at
 * http://api.nameapi.org/soap/v4.0/genderizer/persongenderizer?wsdl
 *
 * HOW TO USE:
 * $personGenderizer = $myServiceFactory->genderizerServices()->personGenderizer();
 * $personGenderResult = $personGenderizer->assess($inputPerson);
 * echo (string)$personGenderResult->getGender(); //prints 'MALE'
 *
 * @since v4.0
 */
class PersonGenderizerService {

    private $context;
    private $soapPersonGenderizerService;

    /**
     * @access public
     */
    public function __construct($apiKey, Context $context, $baseUrl) {
        $this->context = $context;
        $this->soapPersonGenderizerService = new wsdl\SoapPersonGenderizerService(array(), $baseUrl);
    }

    /**
     * @param NaturalInputPerson $person
     * @return PersonGenderResult
     */
    public function assess(NaturalInputPerson $person) {
        $parameters = new wsdl\AssessArguments($this->context, $person);
        return $this->soapPersonGenderizerService->assess($parameters)->getReturn();
    }

}
