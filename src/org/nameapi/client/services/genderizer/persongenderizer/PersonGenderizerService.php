<?php

namespace org\nameapi\client\services\genderizer\persongenderizer;

use org\nameapi\ontology\input\context\Context;
use org\nameapi\ontology\input\entities\person\NaturalInputPerson;

require_once('wsdl/SoapPersonGenderizerService.php');
require_once('PersonGenderResult.php');


/**
 *
 */
class PersonGenderizerService {

    private $context;
    private $soapPersonGenderizerService;

    /**
     * @access public
     */
    public function __construct(Context $context) {
        $this->context = $context;
        $this->soapPersonGenderizerService = new wsdl\SoapPersonGenderizerService();
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
